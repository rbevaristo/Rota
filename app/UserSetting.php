<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $fillable = [
        'sched_dayoff','', 'dayoff', 'shift', 'shuffle', 'user_id','sched_lock'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
