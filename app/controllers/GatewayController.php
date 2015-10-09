<?php

class GatewayController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $gateway = HttpGatewayPush::all();

        // load the view and pass the nerds
        return View::make('gateway.index')
                        ->with('gateway', $gateway);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('gateway.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $gatewayPushValidate = HttpGatewayPush::validate(\Input::all());

        if (!empty($gatewayPushValidate)) {
            return Redirect::to('gateway/create')
                            ->withErrors($gatewayPushValidate)
                            ->withInput(Input::except('password'));
        }

        $gatewayDlrValidate = HttpGatewayDlr::validate([
                    'message_id' => \Input::get('message_id'),
                    'delivery_base_url' => \Input::get('delivery_base_url'),
                    'delivery_api_required' => \Input::get('delivery_api_required'),
                    'uid' => \Input::get('uid'),
        ]);

        if (!empty($gatewayDlrValidate)) {
            return Redirect::to('gateway/create')
                            ->withErrors($gatewayDlrValidate)
                            ->withInput();
        }
        $method = \Input::get('method');

        $gatewayPush = new HttpGatewayPush;
        $gatewayPush->gateway_name = \Input::get('gateway_name');
        $gatewayPush->company_name = \Input::get('company_name');
        $gatewayPush->sender = \Input::get('sender');
        $gatewayPush->gateway_credits = \Input::get('gateway_credits');
        $gatewayPush->mobile = \Input::get('mobile');
        $gatewayPush->message = \Input::get('message');
        $gatewayPush->base_url = \Input::get('base_url');
        $gatewayPush->method = strtoupper($method);
        $gatewayPush->company_mobile = \Input::get('company_mobile');
        $gatewayPush->company_email = \Input::get('company_email');
        $gatewayPush->api_key = \Input::get('api_key');
        $gatewayPush->username = \Input::get('username');
        $gatewayPush->password = \Input::get('password');
        $gatewayPush->additional_params = \Input::get('additional_params');
        $gatewayPush->api_required = \Input::get('api_required');
        $gatewayPush->save();

        $gatewayDlr = new HttpGatewayDlr;
        $gatewayDlr->gateway_id = $gatewayPush->id;
        $gatewayDlr->delivery_base_url = \Input::get('delivery_base_url');
        $gatewayDlr->uid = \Input::get('uid');
        $gatewayDlr->message_id = \Input::get('message_id');
        $gatewayDlr->delivery_api_required = \Input::get('delivery_api_required');
        $gatewayDlr->save();

        Session::flash('message', 'Successfully Created Gateway!');
        return Redirect::to('gateway');
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
