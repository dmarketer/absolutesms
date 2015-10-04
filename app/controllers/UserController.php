<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}
    public function showLogin()
	{
		
		    return View::make('users.login');
	}	
    public function doLogin()
			{
			// validate the info, create rules for the inputs
			$rules = array(
				'username'    => 'required', // make sure the email is an actual email
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
					'user_name'     => Input::get('username'),
					'password'  => Input::get('password')
				);
			//dd(Auth::check($userdata));
				// attempt to do the login
				if (Auth::attempt($userdata)) {

					// validation successful!
					// redirect them to the secure section or whatever
					// return Redirect::to('secure');
					// for now we'll just echo success (even though echoing in a controller is bad)
					echo 'SUCCESS!';
					
				} else {        

					// validation not successful, send back to form 
					return Redirect::to('login');

				}

			}
			}

			public function showRegisterForm()
			{
				   return View::make('users.register');
			}

            public function createRegister()
			{
				  $user_name=Input::get('user_name');
				 $name=Input::get('name');
				 $mobile=Input::get('mobile');
				 $email=Input::get('email');
				 $password=Input::get('password');
				  $input = Input::all();
				
       $validation = Validator::make($input, User::$rules);

        if ($validation->passes())
        {
			$user=new User;
			$user->first_name=$name;
			$user->user_name=$user_name;
			$user->password = Hash::make($password);
			$user->email=$email;
			$user->mobile=$mobile;
			$user->save();
                 $user_id= $user->id;
		        $this->sendOtp($mobile,$user_id);
				
             return Redirect::to('otp')->with('id',$user_id)->with('mobile',$mobile);
        }

		//dd($validation);
		
       return Redirect::to('register')
					->withErrors($validation) // send back all errors to the login form
					->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
			
			}

        public function showOtpForm()
		{ 
		$uid=Session::get('id');
		$mobile=Session::get('mobile');
		$msg=Session::get('msg');
		
			//dd(compact('uid', 'mobile','msg'));
			    return View::make('users.otp', compact('uid', 'mobile','msg'));

		}
        public function verifyotp()
		{
			$otp= Input::get('verify_code');
			$uid= Input::get('user_id');
			$mob= Input::get('mobile');
			$msg='';
		    $users = DB::table('otp')
                    ->where('otp_code',$otp)
					->Where('user_id',$uid)
					->Where('mobile',$mob)
					->get();
					
		if($users)
		{
			//echo "1";
			return Redirect::to('login');
		
		}
		else
		{
			$msg='Please Enter Correct OTP';
		 return Redirect::to('otp')->with('msg',$msg);
			//return Redirect::back()->withErrors([$msg]);
		}
		
		}
		
		
		public function resendotp()
		{
			$mobile=Input::get('mob');
			$user_id=Input::get('uid');
			$this->sendOtp($mobile,$user_id);
			
		}
        // for sending otp to user
	   public function sendOtp($mobile,$user_id)
	    {
		$model= new User;
		$key = rand(1000, 9999);	
        $msg = 'Your activation code is '.$key;
		$msg = urlencode($msg);
		// inserting in OTP table
	         $otp=new Otp;
		   	 $otp->mobile=$mobile;
			 $otp->send_date=date('Y-m-d H:i:s');
	         $otp->user_id=$user_id;
			  $otp->otp_code=$key;
			 $otp->save();
		//	var_dump($otp->getErrors());
		//	exit;
			
			  $otp_id=$otp->id;
			
			//$user= User::model()->updateByPk($user_id,array('otp_id'=>$otp_id));
			$use=DB::table('users')->where('user_id', $user_id)->update(array('otp_id' =>$otp_id));
			if($use)
			{
				$ch = curl_init(); 
				curl_setopt($ch, CURLOPT_URL, 'http://login.dsms.in/httpapi/smsapi?uname=codepix&password=Asdf@123$&sender=CODPIX&receiver='.$mobile.'&route=T&msgtype=1&sms='.$msg.''); 
			   //curl_setopt($ch, CURLOPT_HEADER, 1); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
				$data = curl_exec($ch); 
				 curl_close($ch); 
			}
		
		
	}		
			 
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
