<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluationComments extends Model
{
    protected $fillable = [
        'qualities',
        'improvements',
        'comments',
        'eval_id'
    ];

    public function evaluation(){
        return $this->belongsTo('App\EvaluationResult');
    }
}
