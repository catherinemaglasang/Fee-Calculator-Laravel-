<?php

namespace Thirty98\http\controllers\models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Cities_Fees extends Model
{
    // Laravel auto update timestamp feature.
    public $timestamps = true;

    // Set database for this model.
    protected $table = 'cities_fees';

    // Set primary key.
    protected $primaryKey = 'id';

    // Used for softdeleting.
    protected $dates = ['deleted_at'];

    // Set fillable fields.
    protected $fillable = [];

    public static function updateRaw($cityId, $feeId, $newFeeAmount, $startDate, $endDate)
    {
        // DD - MM - YYYY
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        if ($startDate != false && $endDate != false) {

            $startDate = date('Y-m-d', $startDate);
            $endDate = date('Y-m-d', $endDate);

            if ($endDate > $startDate) {

                $sql = "
                   UPDATE
                      cities_fees
                    SET
                      amount = $newFeeAmount,
                      start_date = '$startDate',
                      end_date = '$endDate'
                    WHERE city_id = $cityId
                      AND fee_id = $feeId
                ";

                DB::statement($sql);

                return "Updated";

            } else {

                return 'Start Date must be before End Date.';

            }

        } else {

            return 'Date Format Incorrect. Use: YYYY-MM-DD';

        }
    }

    public static function getCitiesByState($stateName)
    {
        $sql = "
                SELECT
                  c.id,
                  c.name
                FROM
                  cities c
                  INNER JOIN counties cs
                    ON cs.id = c.county_id
                  INNER JOIN states s
                    ON s.id = cs.state_id
                    AND s.name = :stateName

                ORDER BY c.name
        ";

        $result = DB::select(DB::raw($sql), array(
            'stateName' => $stateName
        ));

        return $result;
    }

    public static function getCityFees($stateName)
    {
        $sql = "SELECT
                  c.id AS city_id,
                  f.id AS fee_id,
                  c.name AS city_name,
                  f.name AS fee_name,
                  cf.amount AS fee_amount,
                  cf.start_date,
                  cf.end_date,
                  DATE_FORMAT(cf.start_date,'%Y-%m-%d') as formatted_start_date,
                  DATE_FORMAT(cf.end_date,'%Y-%m-%d') as formatted_end_date
                FROM
                  cities c
                  INNER JOIN
                    (SELECT
                      id AS county_id,
                      NAME AS county_name
                    FROM
                      counties
                    WHERE state_id =
                      (SELECT
                        id
                      FROM
                        states
                      WHERE NAME = :stateName)) AS louisiana_counties
                    ON louisiana_counties.county_id = c.county_id
                  INNER JOIN cities_fees cf
                    ON cf.city_id = c.id
                  INNER JOIN fees f
                    ON f.id = cf.fee_id ";

        $result = DB::select(DB::raw($sql), array(
            'stateName' => $stateName
        ));

        return $result;
    }
}
