<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = [
        'start','end','status','user_id' 
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function required_shifts(){
        return $this->hasMany('App\RequiredShift', 'shift_id');
    }
}
