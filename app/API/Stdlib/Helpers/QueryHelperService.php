<?php

namespace Thirty98\API\Stdlib\Helpers;

class QueryHelperService
{
    /**
     * Accepts a string and adds query - dynamically determining if it's WHERE or AND.
     * @param $str
     * @param $condition
     */
    public static function addCondition($str, $condition)
    {
        if ($str === "") {
            $str = $str . ' ' . 'WHERE' . ' ' .  $condition;
        } else {
            $str = $str . ' ' . 'AND' . ' ' . $condition;
        }

        return $str;
    }
}
