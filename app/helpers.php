<?php

if (! function_exists('sentence_case')) {
    /**
     * Convert a value to title case.
     *
     * @param  string  $value
     * @return string
     */
    function sentence_case($value)
    {
        return mb_convert_case(mb_substr($value, 0, 1, 'UTF-8'), MB_CASE_UPPER, 'UTF-8').mb_substr($value, 1, null, 'UTF-8');
    }
}