<?php

class Converter
{
    static function toDate($param)
    {
        return date('Y-m-d', strtotime($param));
    }

    static function toTime($param)
    {
        return date('H:i:s', strtotime($param));
    }
}