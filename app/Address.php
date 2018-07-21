<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'street', 'city', 'state', 'zip_code', 'profile_id'
    ];
}
