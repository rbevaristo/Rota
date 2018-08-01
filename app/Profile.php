<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'avatar', 'gender', 'birthdate', 'contact', 'user_id', 'emp_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function employee() {
        return $this->belongsTo('App\Employee');
    }

    public function address() {
        return $this->hasOne('App\Address');
    }
}
