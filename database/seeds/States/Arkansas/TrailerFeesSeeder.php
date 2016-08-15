<?php

namespace Thirty98\Seeder\States\Arkansas;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Thirty98\Models\ARPullingUnit;
use Thirty98\Models\ARRegistrationType;
use Thirty98\Models\ARTagPrefix;
use Thirty98\Models\ARVehicleUseType;
use Thirty98\Models\ARTrailerFee;

use Carbon\Carbon;

class TrailerFeesSeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'AR';
    protected $table_name = 'ar_trailer_fees';

    protected function executeSeeder()
    {
        $ar_tag_prefixes = ARTagPrefix::all();
        $ar_pulling_units = ARPullingUnit::all();
        $ar_vehicle_types_use = ARVehicleUseType::all();
        $ar_reg_types = ARRegistrationType::all();

        $ar_tag_prefixes_indexes = [];
        $ar_pulling_units_indexes = [];
        $ar_vehicle_type_use_indexes = [];
        $ar_reg_types_indexes = [];

        foreach ($ar_tag_prefixes as $ar_tag_prefix) {
            $ar_tag_prefixes_indexes[$ar_tag_prefix['name']] = $ar_tag_prefix['id'];
        }

        foreach ($ar_pulling_units as $ar_pulling_unit) {
            $ar_pulling_units_indexes[$ar_pulling_unit['name']] = $ar_pulling_unit['id'];
        }

        foreach ($ar_vehicle_types_use as $ar_vehicle_type_use_use) {
            $ar_vehicle_type_use_indexes[$ar_vehicle_type_use_use['name']] = $ar_vehicle_type_use_use['id'];
        }

        foreach ($ar_reg_types as $ar_reg_type) {
            $ar_reg_types_indexes[$ar_reg_type['name']] = $ar_reg_type['id'];
        }

        foreach ($this->getTrailerFees() AS $use_type) {
            $ar_tag_prefix_id = $ar_tag_prefixes_indexes[$use_type[0]];
            $ar_pulling_units_id = $ar_pulling_units_indexes[$use_type[1]];
            $ar_min_gvwr = $use_type[2];
            $ar_max_gvwr = $use_type[3];
            $ar_vehicle_use_type_id = $ar_vehicle_type_use_indexes[$use_type[4]];
            $ar_registration_type_id = $ar_reg_types_indexes[$use_type[5]];
            $reg_fee = $use_type[6];
            $start_date = $use_type[7];
            $end_date = $use_type[8];

            $exists = ARTrailerFee::where('tag_prefix_id', '=', $ar_tag_prefix_id)
                ->where('pulling_units_id', '=', $ar_pulling_units_id)
                ->where('min_gvwr', '=', $ar_min_gvwr)
                ->where('max_gvwr', '=', $ar_max_gvwr)
                ->where('vehicle_use_type_id', '=', $ar_vehicle_use_type_id)
                ->where('reg_type_id', '=', $ar_registration_type_id)
                ->where('reg_fee', '=', $reg_fee)
                ->where('start_date', '=', $start_date)
                ->where('end_date', '=', $end_date)
                ->first();

            if (!$exists) {
                $result = ARTrailerFee::insertGetId([
                    'tag_prefix_id' => $ar_tag_prefix_id,
                    'pulling_units_id' => $ar_pulling_units_id,
                    'min_gvwr' => $ar_min_gvwr,
                    'max_gvwr' => $ar_max_gvwr,
                    'vehicle_use_type_id' => $ar_vehicle_use_type_id,
                    'reg_type_id' => $ar_registration_type_id,
                    'reg_fee' => $reg_fee,
                    'start_date' => $start_date,
                    'end_date' => $end_date
                ]);

                if (!$result) {
                    die('Arkansas Trailer Fees Adding Failed. ' . PHP_EOL);
                }
            }

            continue;
        }
    }

    protected function getTrailerFees()
    {
        return [
            [
                "AA",
                "PASSENGER",
                "0",
                "0",
                "PERSONAL",
                "PERMANENT",
                "36.00",
                Carbon::parse('5/1/2014')->format('Y/m/d'),
                Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                "AA",
                "TRK-CLASS1",
                "0",
                "6000",
                "PERSONAL",
                "PERMANENT",
                "36.00",
                Carbon::parse('5/1/2014')->format('Y/m/d'),
                Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                "ST",
                "CLASS2",
                "6001",
                "10000",
                "COMMERCIAL",
                "ANNUAL",
                "20.00",
                Carbon::parse('5/1/2014')->format('Y/m/d'),
                Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                "ST",
                "CLASS3",
                "10001",
                "14000",
                "COMMERCIAL",
                "ANNUAL",
                "20.00",
                Carbon::parse('5/1/2014')->format('Y/m/d'),
                Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                "ST",
                "CLASS4",
                "14001",
                "16000",
                "COMMERCIAL",
                "ANNUAL",
                "20.00",
                Carbon::parse('5/1/2014')->format('Y/m/d'),
                Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                "ST",
                "CLASS5",
                "16001",
                "19500",
                "COMMERCIAL",
                "ANNUAL",
                "20.00",
                Carbon::parse('5/1/2014')->format('Y/m/d'),
                Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                "ST",
                "CLASS6",
                "19500",
                "26000",
                "COMMERCIAL",
                "ANNUAL",
                "20.00",
                Carbon::parse('5/1/2014')->format('Y/m/d'),
                Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                "ST",
                "CLASS7",
                "26001",
                "33000",
                "COMMERCIAL",
                "ANNUAL",
                "20.00",
                Carbon::parse('5/1/2014')->format('Y/m/d'),
                Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                "ST",
                "CLASS8",
                "33001",
                "0",
                "COMMERCIAL",
                "ANNUAL",
                "20.00",
                Carbon::parse('5/1/2014')->format('Y/m/d'),
                Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                "PT",
                "CLASS2",
                "6001",
                "10000",
                "COMMERCIAL",
                "PERMANENT",
                "65.00",
                Carbon::parse('5/1/2014')->format('Y/m/d'),
                Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                "PT",
                "CLASS3",
                "10001",
                "14000",
                "COMMERCIAL",
                "PERMANENT",
                "65.00",
                Carbon::parse('5/1/2014')->format('Y/m/d'),
                Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                "PT",
                "CLASS4",
                "14001",
                "16000",
                "COMMERCIAL",
                "PERMANENT",
                "65.00",
                Carbon::parse('5/1/2014')->format('Y/m/d'),
                Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                "PT",
                "CLASS5",
                "16001",
                "19500",
                "COMMERCIAL",
                "PERMANENT",
                "65.00",
                Carbon::parse('5/1/2014')->format('Y/m/d'),
                Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                "PT",
                "CLASS6",
                "19500",
                "26000",
                "COMMERCIAL",
                "PERMANENT",
                "65.00",
                Carbon::parse('5/1/2014')->format('Y/m/d'),
                Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                "PT",
                "CLASS7",
                "26001",
                "33000",
                "COMMERCIAL",
                "PERMANENT",
                "65.00",
                Carbon::parse('5/1/2014')->format('Y/m/d'),
                Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                "PT",
                "CLASS8",
                "33001",
                "0",
                "COMMERCIAL",
                "PERMANENT",
                "65.00",
                Carbon::parse('5/1/2014')->format('Y/m/d'),
                Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                "T",
                "FULL_TRAILER",
                "0",
                "0",
                "ALL",
                "ANNUAL",
                "0",
                Carbon::parse('5/1/2014')->format('Y/m/d'),
                Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                "T",
                "FULL_FARM_TRAILER",
                "0",
                "0",
                "ALL",
                "ANNUAL",
                "8.00",
                Carbon::parse('5/1/2014')->format('Y/m/d'),
                Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
        ];
    }

}
