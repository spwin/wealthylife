<?php

namespace App\Helpers;

use App\Notifications;
use App\Questions;
use App\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Agent\Agent;

class Helpers
{
    protected static $access = null;

    public static function isMobile(){
        $Agent = new Agent();
        if ($Agent->isMobile() || $Agent->isTablet()) {
            return true;
        } else {
            return false;
        }
    }

    public static function getSetting($name){
        $setting = Settings::where(['name' => $name])->first();
        if($setting){
            return $setting->value;
        } else {
            return null;
        }
    }

    public static function sendNotification($type, $user, $params = []){
        $notification = new Notifications();
        $notification->fill([
            'user_id' => $user->id,
            'importance' => 1,
            'type' => 'system',
            'subject' => trans($type.'topic', $params),
            'body' => trans($type.'content', $params),
            'seen' => 0,
            'email' => 0
        ]);
        /*
         * echo trans('messages.welcome', ['name' => 'dayle']);
            'welcome' => 'Welcome, :NAME', // Welcome, DAYLE
            'goodbye' => 'Goodbye, :Name', // Goodbye, Dayle
         */
        $notification->save();
    }

    public static function sendEmail($type, $email, $user, $params = []){
        Mail::send(trans($type.'email'), ['params' => $params], function ($message) use ($user, $type, $email) {
            $message->subject(trans($type.'subject'));
            $message->from(env('MAIL_USERNAME'), env('APP_NAME'));
            $message->to($email);
            $message->priority('high');
        });
    }

    public static function getExcerpt($max, $string){
        if(strlen($string) > $max){
            $excerpt = substr($string, 0, $max);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt = substr($excerpt, 0, $lastSpace);
            $excerpt .= '...';
        } else {
            $excerpt = $string;
        }
        return $excerpt;
    }

    public static function hideEmail($email) {
        $character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';
        $key = str_shuffle($character_set);
        $cipher_text = '';
        $id = 'e'.rand(1,999999999);
        for ($i=0;$i<strlen($email);$i+=1)
            $cipher_text.= $key[strpos($character_set,$email[$i])];
        $script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";';
        $script.= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));';
        $script.= 'document.getElementById("'.$id.'").innerHTML="<strong>"+d+"</strong>"';
        $script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'), $script)."\")";
        $script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>';
        return '<span id="'.$id.'" class ="something-cool">m<b>@</b>e@d<b>no</b>oma<b>.com</b>in.com</span>'.$script;}

    public static function getPending(){
        $pending = 0;
        if($user = Auth::guard('consultant')->user()){
            $pending = Questions::where(['consultant_id' => $user->id, 'status' => 1])->count();
        }
        return $pending;
    }

    public static function checkAccess()
    {
        $current = self::$access;
        if(is_null($current)){
            $limitedAccesMode = Helpers::getSetting('limited_access');
            if ($limitedAccesMode) {
                $allow_ip = [
                    '127.0.0.1',
                    '95.148.189.54',
                    '5.81.190.114',
                    '86.150.64.122',
                    '78.56.165.176',
                    '78.56.180.116',
                    '188.69.215.193',
                    '86.146.148.90',
                    '188.69.210.99',
                    '86.177.253.228',
                    '90.152.1.58',
                    '94.10.101.126',
                    '86.159.238.141',
                    '2.219.251.44'
                ];

                if (in_array(request()->ip(), $allow_ip)) {
                    $current = true;
                } else {
                    $current = false;
                }
            } else {
                $current = true;
            }
            self::$access = $current;
        }
        return $current;
    }
}