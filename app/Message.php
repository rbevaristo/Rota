<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'title', 'message', 'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function employee() {
        return $this->belongsTo('App\Employee');
    }
}