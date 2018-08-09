<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluationComments extends Model
{
    protected $fillable = [
        'best_qualities_demonstrated',
        'how_improvements_can_be_made',
        'comments',
        'eval_id'
    ];

    public function evaluation(){
        return $this->belongsTo('App\EvaluationResult');
    }
}
