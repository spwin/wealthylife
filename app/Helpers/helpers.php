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
}