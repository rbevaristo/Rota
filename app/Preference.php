<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $fillable = [
        'emp_id', 'dayoff', 'shift'
    ];

    public function employee() {
        return $this->belongsTo('App\Employee');
    }
}
