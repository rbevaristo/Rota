<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $fillable = [
        'sharing', 'dayoff', 'shift', 'shuffle', 'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
