<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'gender', 'birthdate', 'contact', 'address_id', 'user_id', 'employee_id'
    ];
}
