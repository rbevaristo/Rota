<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluationResult extends Model
{
    protected $fillable = [
            'Quality_of_Work',
            'Efficiency_of_Work',
            'Dependability',
            'Job_Knowledge',
            'Attitude',
            'Housekeeping',
            'Reliability',
            'Personal_Care',
            'Judgement',
            'emp_id',
            'user_id'
    ];

    public function employee(){
        return $this->belongsTo('App\Employee');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function comments() {
        return $this->hasOne('App\EvaluationComments');
    }
}
