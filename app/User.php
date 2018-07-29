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
        'firstname', 'lastname', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function employees() {
        return $this->hasMany('App\Employee');
    }

    public function profile() {
        return $this->hasOne('App\Profile');
    }

    public function setting() {
        return $this->hasOne('App\Setting');
    }

    public function positions() {
        return $this->hasMany('App\Position');
    }

    public function requests() {
        return $this->hasMany('App\Request');
    }

    public function company() {
        return $this->hasOne('App\Company');
    }
}
