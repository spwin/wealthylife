<?php

namespace App\Helpers;

use App\Settings;

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


}