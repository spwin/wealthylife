<?php

namespace App\Helpers;

use App\Settings;
use Illuminate\Support\Facades\Mail;

class Helpers
{
    public static function getSetting($name){
        $setting = Settings::where(['name' => $name])->first();
        if($setting){
            return $setting->value;
        } else {
            return null;
        }
    }

    public static function sendNotification($type, $id, $params = []){

    }

    public static function sendEmail($type, $email, $user, $params = []){
        Mail::send(trans($type.'email'), ['params' => $params], function ($message) use ($user, $type, $email) {
            $message->subject(trans($type.'subject'));
            $message->from(env('MAIL_USERNAME'), env('APP_NAME'));
            $message->to($email);
            $message->priority('high');
        });
    }

}