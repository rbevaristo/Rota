<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    protected $fillable = [
        'title', 'message', 'from', 'upto', 'emp_id', 'approved', 'user_id',
    ];

    public function employee() {
        return $this->belongsTo('App\Employee');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
