<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    protected $fillable = [
        'request', 'start_date', 'end_date', 'message', 'user'
    ];

    public function employee() {
        return $this->belongsTo('App\Employee');
    }

    public function request() {
        return $this->belongsTo('App\Request');
    }
}
