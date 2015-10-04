<?php

class UserController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    public function showLogin() {

        return View::make('users.login');
    }

    public function doLogin() {
        // validate the info, create rules for the inputs
        $rules = array(
            'username' => 'required', // make sure the email is an actual email
            'password' => 'required|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('login')
                            ->withErrors($validator) // send back all errors to the login form
                            ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            $userdata = array(
                'user_name' => Input::get('username'),
                'password' => Input::get('password')

            );
            //dd(Auth::check($userdata));
            // attempt to do the login
            if (Auth::attempt($userdata)) {

                // validation successful!
                // redirect them to the secure section or whatever
                // return Redirect::to('secure');
                // for now we'll just echo success (even though echoing in a controller is bad)
                $userInfo = User::where('user_name', $userdata['user_name'])->get()->toArray();
                Session::put('user_id', $userInfo[0]['user_id']);
                Session::put('user_name', $userInfo[0]['user_name']);
                Session::put('email', $userInfo[0]['email']);
                return Redirect::to('sendsms');
            } else {

                // validation not successful, send back to form 
                return Redirect::to('login');
            }
        }
    }

    public function showRegisterForm() {
        return View::make('users.register');
    }

    public function createRegister() {
        $user_name = Input::get('user_name');
        $name = Input::get('name');
        $mobile = Input::get('mobile');
        $email = Input::get('email');
        $password = Input::get('password');
        $input = Input::all();
        $messages = array(
            'cfm_password.same' => 'Password and Confirm Password not match',
            'cfm_password.required' => 'The Confirm Password field is required.'
        );
        $validation = Validator::make($input, User::$rules, $messages);
        //dd($validation->fails());
        if ($validation->passes()) {
            $user = new User;
            $user->first_name = $name;
            $user->user_name = $user_name;
            $user->password = Hash::make($password);
            $user->email = $email;
            $user->mobile = $mobile;
            $user->save();
            $user_id = $user->id;
            $this->sendOtp($mobile, $user_id);

            return Redirect::to('otp')->with('id', $user_id)->with('mobile', $mobile);
        }

        //dd($validation);

        return Redirect::to('register')
                        ->withErrors($validation) // send back all errors to the login form
                        ->withInput(); // send back the input (not the password) so that we can repopulate the form
    }

    public function showOtpForm() {
        $uid = Session::get('id');
        $mobile = Session::get('mobile');
        $msg = Session::get('msg');

        //dd(compact('uid', 'mobile','msg'));
        return View::make('users.otp', compact('uid', 'mobile', 'msg'));
    }

    public function verifyotp() {
        $otp = Input::get('verify_code');
        $uid = Input::get('user_id');
        $mob = Input::get('mobile');
        $msg = '';
        $users = DB::table('otp')
                ->where('otp_code', $otp)
                ->Where('user_id', $uid)
                ->Where('mobile', $mob)
                ->get();

        if ($users) {
            //echo "1";
            $use = DB::table('users')->where('user_id', $uid)->update(array('status' => 'ACTIVE', 'activated_at' => date('Y-m-d H:i:s')));
            $otp = DB::table('users')->where('user_id', $uid)->first();
            $otp_up = DB::table('otp')->where('id', $otp->otp_id)->update(array('verified_date' => date('Y-m-d H:i:s')));
          //if user is changing number from acount info         
		 if (Session::has('user_id'))
		  {
			   return Redirect::to('userinfo');
		  }
		  else{
		  return Redirect::to('login');
		  }
        } else {
            $msg = 'Please Enter Correct OTP';
            return Redirect::to('otp')->with('msg', $msg)->with('id', $uid)->with('mobile', $mob);
            //return Redirect::back()->withErrors([$msg]);
        }
    }

    public function resendotp() {
        $mobile = Input::get('mob');
        $user_id = Input::get('uid');
        $this->sendOtp($mobile, $user_id);
    }

    // for sending otp to user
    public function sendOtp($mobile, $user_id) {
        $model = new User;
        $key = rand(1000, 9999);
        $msg = 'Your activation code is ' . $key;
        $msg = urlencode($msg);
        // inserting in OTP table
        $otp = new Otp;
        $otp->mobile = $mobile;
        $otp->sent_date = date('Y-m-d H:i:s');
        $otp->user_id = $user_id;
        $otp->otp_code = $key;
        $otp->save();
        //	var_dump($otp->getErrors());
        //	exit;

        $otp_id = $otp->id;

        //$user= User::model()->updateByPk($user_id,array('otp_id'=>$otp_id));
        $use = DB::table('users')->where('user_id', $user_id)->update(array('otp_id' => $otp_id));
        if ($use) {

            $ch = curl_init();
            //curl_setopt($ch, CURLOPT_URL, 'http://login.dsms.in/httpapi/smsapi?uname=codepix&password=Asdf@123$&sender=CODPIX&receiver='.$mobile.'&route=T&msgtype=1&sms='.$msg.''); 

            curl_setopt($ch, CURLOPT_URL, 'http://login.dsms.in/httpapi/httpapi?token=8b7f9a79edcd9a4b17ff13ef218c4519&sender=DynSMS&number=' . $mobile . '&route=2&type=1&sms=' . $msg . '');
            //curl_setopt($ch, CURLOPT_HEADER, 1); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($ch);
            curl_close($ch);
            echo "1";
        } else {
            echo "0";
        }
    }
	public function userinfo() 
	{	
	    $userId=Session::get('user_id');
		$users = DB::table('users')->where('user_id', $userId)->first();
      
        return View::make('users.userinfo')->with('users',$users);
    }
	public function updateuser()
	{
		$userId=Session::get('user_id');
        $name = Input::get('name');
        $mobile = Input::get('mobile');
        $email = Input::get('email');
        $company = Input::get('company');
		$address = Input::get('address');
		$users=DB::table('users')->where('user_id', $userId)->first();
		$oldMob=$users->mobile;
       $updateInfo = DB::table('users')->where('user_id', $userId)->update(array('company_name' => $company,'first_name'=>$name,'mobile'=>$mobile,'email'=>$email,'address'=>$address));
	   if($updateInfo)
	   {
		   $userUp=DB::table('users')->where('user_id', $userId)->first();
		   $newMob=$userUp->mobile;
		   if($oldMob==$newMob)
		   {
		   return Redirect::to('userinfo')->withInput()->with('success', 'Updated Successfully.');
		   }
		   else
		   {
			   $this->sendOtp($mobile, $userId);
			    return Redirect::to('otp')->with('id', $userId)->with('mobile', $mobile);
		   }

	   }
	  
	}
	
	public function changePassword()
	{
		 return View::make('users.changepwd');
	}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
