<?php

class HttpGatewayDlr extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'http_gateway_dlr';

    public static function validate($input) {
        $rules = array(
            'delivery_base_url' => 'required',
            'delivery_api_required' => 'required',
            'uid' => 'required',
            'message_id' => 'required'
        );

        $validate = Validator::make($input, $rules);

        $errorMessages = [];
        
        if ($validate->fails()) {
            $errorMessages = $validate->messages();
        }

        return $errorMessages;
    }

}
