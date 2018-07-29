<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomPosition extends Model
{
    protected $fillable = [
        'name', 'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function employees() {
        return $this->hasMany('App\Employee');
    }
}
