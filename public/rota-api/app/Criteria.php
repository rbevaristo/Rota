<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $fillable = [
        'age', 'age_range', 'gender', 'gender_value', 'name', 'name_value', 'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
