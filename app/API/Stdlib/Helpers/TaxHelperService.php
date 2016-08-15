<?php

namespace Thirty98\API\Stdlib\Helpers;

class TaxHelperService
{
    public static function getDecimal($amount)
    {
        $amount = explode('.', $amount);
        $decimal = isset($amount[1]) ? $amount[1] : false;

        return $decimal;
    }

    public static function checkBoundary($num, $min, $max)
    {
        if ($num == $min || $num == $max || ($num >= $min && $num < $max)) {
            return true;
        } else {
            return false;
        }
    }

    public static function removeDecimal($amount)
    {
        if (strpos($amount, '.')) {
            return explode('.', $amount)[0];
        } else {
            return false;
        }
    }

    public static function toFloatValue($floatVal)
    {
        return (float) preg_replace('/[\$,%]/', '', $floatVal);
    }
}
