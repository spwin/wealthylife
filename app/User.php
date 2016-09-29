<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Billable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'email', 'password', 'super', 'points', 'status', 'local', 'email_confirmed', 'welcome', 'referral_key', 'referral_id', 'referral_rewarded', 'referrals_registered', 'referrals_confirmed', 'referrals_points'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userData(){
        return $this->hasOne('App\UserData', 'user_id', 'id');
    }

    public function pointsHistory(){
        return $this->hasMany('App\Points', 'user_id', 'id');
    }

    public function key(){
        return $this->hasOne('App\UserData', 'user_id', 'id');
    }

    public function social(){
        return $this->hasMany('App\UserSocial', 'user_id', 'id');
    }

    public function questions(){
        switch($this->type){
            case 'user' :
                return $this->hasMany('App\Questions', 'user_id', 'id');
                break;
            case 'consultant' :
                return $this->hasMany('App\Questions', 'consultant_id', 'id');
                break;
            default :
                return null;
            break;
        }
    }

    public function answers(){
        if($this->type == 'consultant'){
            return $this->hasMany('App\Answers', 'consultant_id', 'id');
        } else {
            return null;
        }
    }

    public function orders(){
        return $this->hasMany('App\Orders', 'user_id', 'id');
    }

    public function notifications(){
        return $this->hasMany('App\Notifications', 'user_id', 'id');
    }

    public function articles(){
        return $this->hasMany('App\Article', 'user_id', 'id');
    }

    public function token(){
        return $this->hasOne('App\PasswordResets', 'user_id', 'id');
    }

    public function referral(){
        return $this->hasOne('App\User', 'referral_user', 'id');
    }

    public function referrals(){
        return $this->hasMany('App\User', 'id', 'referral_user');
    }

    public function discounts(){
        return $this->hasMany('App\Discounts', 'user_id', 'id');
    }

    public function orderDrafts(){
        return $this->hasMany('App\OrderDrafts', 'user_id', 'id');
    }

    public function feedback(){
        return $this->hasMany('App\Feedback', 'user_id', 'id');
    }

    public function balance(){
        return $this->hasMany('App\Balance', 'user_id', 'id')->orderBy('created_at', 'DESC');
    }
}
