<?php

class Helper 
{
    static function name()
    {
        return auth()->user()->firstname . " " . auth()->user()->lastname;
    } 
}