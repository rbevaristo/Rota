<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_id', 'name', 'email', 'password', 'position', 'role_id', 'user_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
