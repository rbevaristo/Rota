<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
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

    public function required_shifts(){
        return $this->hasMany('App\RequiredShift');
    }
}
