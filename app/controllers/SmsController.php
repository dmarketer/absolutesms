<?php

class SmsController extends \BaseController {

    public function sendsms() {        
        return \View::make('sms.sendsms');
    }
    
    public function send()
    {
        dd(\Input::all());
    }
}
