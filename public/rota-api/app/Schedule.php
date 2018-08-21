<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'user_id', 'filename', 'data'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
