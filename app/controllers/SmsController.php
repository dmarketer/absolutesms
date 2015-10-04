<?php

class SmsController extends \BaseController {

    public function sendsms() {
        return \View::make('sms.sendsms');
    }

}
