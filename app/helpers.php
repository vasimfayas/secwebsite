<?php
if (!function_exists('formatIndianNumber')) {
    function formatIndianNumber($number)
    {
        $number = preg_replace('/[^0-9]/', '', $number); // Remove non-numeric characters
        if ($number == '') return '_____';

        $length = strlen($number);
        if ($length <= 3) return $number;

        $last3 = substr($number, -3);
        $rest = substr($number, 0, $length - 3);
        $rest = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $rest);
        return $rest . "," . $last3;
    }
}
