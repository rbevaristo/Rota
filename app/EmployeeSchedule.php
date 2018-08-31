<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeSchedule extends Model
{
    protected $fillable = ['emp_id','user_id','schedule'];
    //

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function employee() {
        return $this->belongsTo('App\Employee');
    }
}
