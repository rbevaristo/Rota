<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable implements \Tymon\JWTAuth\Contracts\JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id','firstname', 'lastname', 'email', 'password', 'role_id', 'user_id', 'position_id'
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
        return $this->hasOne('App\Profile', 'emp_id');
    }

    public function position() {
        return $this->belongsTo('App\Position');
    }

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function user_requests() {
        return $this->hasMany('App\UserRequest', 'emp_id');
    }

    public function evaluation_results() {
        return $this->hasMany('App\EvaluationResult', 'emp_id');
    }

    public function evaluation_files() {
        return $this->hasMany('App\EvaluationFile', 'emp_id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}