<?php
class SmsController extends \BaseController {

    public function sendsms()
    {
        dd(Session::get('user_id'));
        echo 'hi';
    }
}
