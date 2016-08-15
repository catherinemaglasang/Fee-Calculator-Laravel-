<?php

namespace Thirty98\API\General\Entities;


use Illuminate\Support\Facades\Request;

class Helper
{
    /**
     * Round up value to nearest hundredths.
     *
     * @param int $value
     * @return float
     */
    public static function roundUpToHundreds($value = 0)
    {
        return ceil($value / 100) * 100;
    }

    /**
     * Parse query string to an array.
     *
     * @param string $query
     * @return array
     */
    public static function queryToArray($query = '')
    {
        if (!$query) return [];

        $queries = explode(',', $query);

        $response = [];

        foreach ($queries as $q) {
            $query = explode(':', $q);

            list($field, $value) = $query;

            $response[$field] = $value;
        }

        return $response;
    }

    /**
     * Get page limit. Used for pagination.
     *
     * @return int
     */
    public static function pageLimit()
    {
        $request = Request::instance();

        return $request->get('limit', 50);
    }
}

#END OF PHP FILE