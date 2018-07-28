<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use Notifiable;

    protected $guard = 'employee';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id', 'name', 'email', 'password', 'position_id', 'role_id', 'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function profile() {
        return $this->hasOne('App\Profile');
    }

    public function position() {
        return $this->belongsTo('App\Position');
    }

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function requests() {
        return $this->hasMany('App\UserRequest');
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }
}
