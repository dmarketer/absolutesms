<?php

class HttpGatewayPush extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'http_gateway_push';

    public static function validate($input) {
        $rules = array(
            'api_required' => 'required',
            'gateway_name' => 'required',
            'company_name' => 'required',
            'sender' => 'required',
            'gateway_credits' => 'required',
            'mobile' => 'required',
            'message' => 'required',
            'base_url' => 'required',
            'method' => 'required',
            'company_mobile' => 'required|numeric',
            'company_email' => 'required|email',
        );

        $validate = Validator::make($input, $rules);

        $errorMessages = [];
        
        if ($validate->fails()) {
            $errorMessages = $validate->messages();
        }

        return $errorMessages;
    }

}
