<?php

class Helper 
{
    static function name()
    {
        return auth()->user()->firstname . " " . auth()->user()->lastname;
    } 

    static function employee($firstname, $lastname) {
        return $firstname . " " . $lastname;
    }
}