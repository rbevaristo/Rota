<?php

class Helper 
{
    static function name()
    {
        return auth()->user()->firstname . " " . auth()->user()->lastname;
    } 

    static function employee() {
        return auth()->guard('employee')->user()->firstname . " " . auth()->guard('employee')->user()->lastname;
    }

    static function employee_name($firstname, $lastname) {
        return $firstname . " " . $lastname;
    }
}