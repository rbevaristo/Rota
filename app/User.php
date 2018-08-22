<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password', 'verified', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function positions() {
        return $this->hasMany('App\Position');
    }

    public function company() {
        return $this->hasOne('App\Company');
    }

    public function request_types() {
        return $this->hasMany('App\RequestType');
    }

    public function profile() {
        return $this->hasOne('App\Profile', 'user_id');
    }

    public function setting() {
        return $this->hasOne('App\UserSetting');
    }

    public function employees() {
        return $this->hasMany('App\Employee');
    }

    public function user_requests() {
        return $this->hasMany('App\UserRequest', 'user_id');
    }

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function verify() {
        return $this->hasOne('App\VerifyUsers');
    }

    public function evaluation_results(){
        return $this->hasMany('App\EvaluationResult', 'user_id');
    }

    public function evaluation_files(){
        return $this->hasMany('App\EvaluationFile', 'user_id');
    }

    public function criteria(){
        return $this->hasOne('App\Criteria');
    }

    public function shifts(){
        return $this->hasMany('App\Shift');
    }

    public function required_shifts(){
        return $this->hasMany('App\RequiredShift', 'user_id');
    }

    public function scheduler(){
        return $this->hasOne('App\Scheduler');
    }

}
