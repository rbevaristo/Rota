<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeePasswordReset extends Model
{
    protected $fillable = [
        'username', 'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

}
