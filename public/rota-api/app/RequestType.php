<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestType extends Model
{
    protected $fillable = [
        'name', 'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function user_requests() {
        return $this->hasMany('App\UserRequest');
    }
}
