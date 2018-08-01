<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'number', 'street', 'city', 'state', 'zip', 'country', 'profile_id'
    ];

    public function profile() {
        return $this->belongsTo('App\Profile');
    }
}
