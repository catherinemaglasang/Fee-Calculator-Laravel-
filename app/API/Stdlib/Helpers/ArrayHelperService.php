<?php

namespace Thirty98\API\Stdlib\Helpers;

class ArrayHelperService
{
    /**
     * @param $range - index to insert array in between
     * @param $arrValues - data to insert between the indexes
     * @param $arrData - data to be inserted to
     * @return array - return type
     */
    public static function insertBetweenIndex($range, $arrValues, $arrData)
    {
        $arrValues = array_values($arrValues);
        $arrData = array_values($arrData);

        $index_1 = 0;
        $index_2 = $range;
        $end_index = count($arrData);

        $begin = array_slice($arrData, $index_1, $index_2);
        $end = array_slice($arrData, $index_2, $end_index);

        $result = $begin;

        foreach ($arrValues as $arr_data) {
            $result[] = $arr_data;
        }

        $result = array_values(array_merge($result, $end));

        return $result;
    }

    /**
     * Sort an array based on specific key.
     * @param $arr
     * @param $arrKey
     */
    public static function sortArrayByKey($arr, $arrKey)
    {
        usort($arr, function ($a, $b) use ($arrKey) {
            if ($a[$arrKey] > $b[$arrKey]) {
                return 1;
            }

            return 0;
        });

        return $arr;
    }

    /**
     * Find an array based on specific key.
     * @param $arr
     * @param $arrKey
     * @return bool|int
     */
    public static function findArrayByKey($arr, $arrKey)
    {
        $arr_length = sizeof($arr);

        for ($i = 0; $i < $arr_length; $i++) {
            if($arr[$i]['name'] === $arrKey) {
                return $i;
            }
        }

        return false;
    }
}
