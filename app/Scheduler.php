<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scheduler extends Model
{
    protected $fillable = [
        'user_id', 'schedule'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
