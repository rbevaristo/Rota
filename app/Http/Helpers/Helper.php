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

    static function limit_message($message, $limit) {
        if (str_word_count($message, 0) > $limit) {
            $words = str_word_count($message, 2);
            $pos = array_keys($words);
            $message = substr($message, 0, $pos[$limit]) . '...';
        }
        return $message;
    }

    static function change_to_icon($text) {
        return substr(substr($string, 0, 1));
    }

    static function get_shift($shift){
        return $shift->start . ' - ' . $shift->end;
    }
}