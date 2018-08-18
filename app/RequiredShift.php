<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequiredShift extends Model
{
    protected $fillable = [
        'position_id', 'min', 'max', 'shift_id','user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function position(){
        return $this->belongsTo('App\Position');
    }

    public function shift(){
        return $this->belongsTo('App\User');
    }
}
