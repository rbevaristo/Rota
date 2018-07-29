<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [
        'name'
    ];

    public function employees() {
        return $this->hasMany('App\Employee');
    }
}
