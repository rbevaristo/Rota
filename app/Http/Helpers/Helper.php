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

    static function getStartToEndAMPM($start,$endx){
        $sth = (int)(substr($start,0,2));
        $stm = (int)(substr($start,3,5));
        $enh = (int)(substr($endx,0,2));
        $enm = (int)(substr($endx,3,5));
        $st1 = ($sth<13?$sth:$sth-12);
        $en1 = ($enh<13?$enh:$enh-12);
        $st = ($st1==0?12:$st1) . ($stm==0?"":(":"+($stm<10?"0":"")+$stm)) . ($sth<12?"AM":"PM");
        $en = ($en1==0?12:$en1) . ($enm==0?"":(":"+($enm<10?"0":"")+$enm)) . ($enh<12?"AM":"PM");
        return $st . " - " . $en;
    }
}