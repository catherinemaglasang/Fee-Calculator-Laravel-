<?php

namespace Thirty98\API\Stdlib\Helpers;

class RequestHelperService
{
    /**
     * Check index is set in array, usually used in post requests.
     * @param $arr
     * @param $index
     * @param $return_value
     * @return bool
     */
    public static function ifParam($arr, $index, $return_value = false)
    {
        if (isset($arr[$index])) {
            if ($return_value == true) {
                return $arr[$index];
            } else {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns true or false if the value is set or not, also has an option to return the parameter's value instead of true by
     * making the return_value TRUE.
     * @param $multiIndexedParam
     * @param bool|false $return_value
     * @return bool
     */
    public static function ifMultiIndexParam($multiIndexedParam, $return_value = false)
    {
        if (isset($multiIndexedParam)) {
            if ($return_value == true) {
                return $multiIndexedParam;
            } else {
                return true;
            }
        }

        return false;
    }
}
