<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluationFile extends Model
{
    protected $fillable = [
        'filename', 'emp_id', 'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function employee(){
        return $this->belongsTo('App\Employee');
    }
}
