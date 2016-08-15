<?php

namespace Thirty98\Http\Controllers\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class LALicenseTruckWeightFees extends Model
{
    // Set database for this model.
    protected $table = 'la_license_truck_weight_fees';

    public static function getFee($gvwr, $type, $category)
    {
        $sql = "
            SELECT
              tf.formula
            FROM
              la_license_truck_weight_fees tf
              INNER JOIN `categories_types` ct
                ON ct.id = tf.`category_type_id`
                AND :gvwr BETWEEN tf.`begin_weight`
                AND tf.`end_weight`
              INNER JOIN `types` t
                ON t.id = ct.`type_id`
                AND t.name = :type
              INNER JOIN `categories` c
                ON c.id = ct.`category_id`
                AND c.name = :category
            WHERE tf.`plate_type_id` IS NULL
        ";

        $sql_raw = "
            SELECT
              tf.formula
            FROM
              la_license_truck_weight_fees tf
              INNER JOIN `categories_types` ct
                ON ct.id = tf.`category_type_id`
                AND '$gvwr' BETWEEN tf.`begin_weight`
                AND tf.`end_weight`
              INNER JOIN `types` t
                ON t.id = ct.`type_id`
                AND t.name = '$type'
              INNER JOIN `categories` c
                ON c.id = ct.`category_id`
                AND c.name = '$category'
            WHERE tf.`plate_type_id` IS NULL
        ";


        $result = DB::select(
            DB::raw($sql),
            [
                'type' => $type,
                'category' => $category,
                'gvwr' => $gvwr
            ]
        );

        if ($result) {
            return $result;
        } else {
            return 'No result.';
        }
    }

    public static function getFeeByPlate($gvwr, $type, $category, $plateName)
    {
        $sql = "
            SELECT
              tf.formula
            FROM
              la_license_truck_weight_fees tf
              INNER JOIN `categories_types` ct
                ON ct.id = tf.`category_type_id`
                AND :gvwr BETWEEN tf.`begin_weight`
                AND tf.`end_weight`
              INNER JOIN `types` t
                ON t.id = ct.`type_id`
                AND t.name = :type
              INNER JOIN `categories` c
                ON c.id = ct.`category_id`
                AND c.name = :category
            WHERE tf.`plate_type_id` =
              (SELECT
                id
              FROM
                plate_types
              WHERE `name` = :plateName)
        ";


        $result = DB::select(
            DB::raw($sql),
            [
                'type' => $type,
                'category' => $category,
                'plateName' => $plateName,
                'gvwr' => $gvwr
            ]
        );

        if ($result) {
            return $result;
        } else {
            return 'no result plate';
        }
    }
}
#END OF PHP