<?php

namespace Thirty98\Seeder\States\Louisiana;

use Carbon\Carbon;
use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Thirty98\Models;
use Thirty98\Models\StateVehicleType;
use Thirty98\Models\LALicenseWeightFee;
use Thirty98\Models\VehicleType;

class LALicenseWeightFeesSeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'LA';
    protected $table_name = 'la_license_weight_fees';

    protected function executeSeeder()
    {
        // Build vehicle index.
        $vehicleTypes = VehicleType::all();
        $vehicleTypeIndexes = [];

        $vehicleTypesLA = StateVehicleType::where('state_code', $this->state_code)->get();
        $vehicleTypeLAIndexes = [];

        // Build indexes for fast insert.
        foreach ($vehicleTypes as $key => $value) {
            $vehicleTypeIndexes[$value['slug']] = $value['id'];
        }

        foreach ($vehicleTypesLA as $key => $value) {
            $vehicleTypeLAIndexes[$value['vehicle_type_id']] = $value['id'];
        }

        foreach($this->getLicenseWeightFees() as $licenseWeightFee) {
            $vehicleID = $vehicleTypeIndexes[$licenseWeightFee['vehicle_slug']];

            // Column data.
            $stateVehicleID = $vehicleTypeLAIndexes[$vehicleID];
            $beginWeight = $licenseWeightFee['begin_weight'];
            $endWeight = $licenseWeightFee['end_weight'];
            $fee = $licenseWeightFee['fee'];
            $perPoundRate = $licenseWeightFee['per_pound_rate'];
            $isRate = $licenseWeightFee['is_rate'];
            $isFarm = $licenseWeightFee['is_farm'];
            $prorated = $licenseWeightFee['prorated'];
            $startDate = $licenseWeightFee['start_date'];
            $endDate = $licenseWeightFee['end_date'];

            $exists = LALicenseWeightFee::where('state_vehicle_type_id', $stateVehicleID)
                ->where('begin_weight', $beginWeight)
                ->where('end_weight', $endWeight)
                ->where('fee', $fee)
                ->where('per_pound_rate', $perPoundRate)
                ->where('is_rate', $isRate)
                ->where('is_farm', $isFarm)
                ->where('prorated', $prorated)
                ->where('start_date', $startDate)
                ->where('end_date', $endDate)
                ->first();

            if(!$exists) {
                $result = LALicenseWeightFee::insertGetId([
                    'state_vehicle_type_id' => $stateVehicleID,
                    'begin_weight' => $beginWeight,
                    'end_weight' => $endWeight,
                    'fee' => $fee,
                    'per_pound_rate' => $perPoundRate,
                    'is_rate' => $isRate,
                    'is_farm' => $isFarm,
                    'prorated' => $prorated,
                    'start_date' => $startDate,
                    'end_date' => $endDate
                ]);

                if(!is_numeric($result)) { die('Error inserting.'); }
            }

            continue;
        }
    }

    private function getLicenseWeightFees()
    {
        return [
            // Truck
           [
                'vehicle_slug' => $this->slugit('truck'),
                'begin_weight' => 0,
                'end_weight' => 6000,
                'fee' => 40.00,
                'per_pound_rate' => 0,
                'is_rate' => false,
                'is_farm' => false,
                'prorated' => false,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                'vehicle_slug' => $this->slugit('truck'),
                'begin_weight' => 6000,
                'end_weight' => 10000,
                'fee' => 112.00,
                'per_pound_rate' => 0,
                'is_rate' => false,
                'is_farm' => false,
                'prorated' => false,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            // Prorated trucks
            [
                'vehicle_slug' => $this->slugit('truck'),
                'begin_weight' => 10001,
                'end_weight' => 23999,
                'fee' => 0.38,
                'per_pound_rate' => 100,
                'is_rate' => true,
                'is_farm' => false,
                'prorated' => true,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                'vehicle_slug' => $this->slugit('truck'),
                'begin_weight' => 24000,
                'end_weight' => 37999,
                'fee' => 0.60,
                'per_pound_rate' => 100,
                'is_rate' => true,
                'is_farm' => false,
                'prorated' => true,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                'vehicle_slug' => $this->slugit('truck'),
                'begin_weight' => 38000,
                'end_weight' => 80000,
                'fee' => 0.63,
                'per_pound_rate' => 100,
                'is_rate' => true,
                'is_farm' => false,
                'prorated' => true,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                'vehicle_slug' => $this->slugit('truck'),
                'begin_weight' => 80001,
                'end_weight' => 88000,
                'fee' => 0.64,
                'per_pound_rate' => 100,
                'is_rate' => true,
                'is_farm' => false,
                'prorated' => true,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],

            // Prorated Cars
            [
                'vehicle_slug' => $this->slugit('car'),
                'begin_weight' => 10001,
                'end_weight' => 23999,
                'fee' => 0.38,
                'per_pound_rate' => 100,
                'is_rate' => true,
                'is_farm' => false,
                'prorated' => true,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                'vehicle_slug' => $this->slugit('car'),
                'begin_weight' => 24000,
                'end_weight' => 37999,
                'fee' => 0.60,
                'per_pound_rate' => 100,
                'is_rate' => true,
                'is_farm' => false,
                'prorated' => true,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                'vehicle_slug' => $this->slugit('car'),
                'begin_weight' => 38000,
                'end_weight' => 80000,
                'fee' => 0.63,
                'per_pound_rate' => 100,
                'is_rate' => true,
                'is_farm' => false,
                'prorated' => true,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                'vehicle_slug' => $this->slugit('car'),
                'begin_weight' => 80001,
                'end_weight' => 88000,
                'fee' => 0.64,
                'per_pound_rate' => 100,
                'is_rate' => true,
                'is_farm' => false,
                'prorated' => true,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            // Van
            [
                'vehicle_slug' => $this->slugit('van'),
                'begin_weight' => 10001,
                'end_weight' => 23999,
                'fee' => 0.38,
                'per_pound_rate' => 100,
                'is_rate' => true,
                'is_farm' => false,
                'prorated' => true,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                'vehicle_slug' => $this->slugit('van'),
                'begin_weight' => 24000,
                'end_weight' => 37999,
                'fee' => 0.60,
                'per_pound_rate' => 100,
                'is_rate' => true,
                'is_farm' => false,
                'prorated' => true,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                'vehicle_slug' => $this->slugit('van'),
                'begin_weight' => 38000,
                'end_weight' => 80000,
                'fee' => 0.63,
                'per_pound_rate' => 100,
                'is_rate' => true,
                'is_farm' => false,
                'prorated' => true,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                'vehicle_slug' => $this->slugit('van'),
                'begin_weight' => 80001,
                'end_weight' => 88000,
                'fee' => 0.64,
                'per_pound_rate' => 100,
                'is_rate' => true,
                'is_farm' => false,
                'prorated' => true,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],

            // SUV
            [
                'vehicle_slug' => $this->slugit('SUV'),
                'begin_weight' => 10001,
                'end_weight' => 23999,
                'fee' => 0.38,
                'per_pound_rate' => 100,
                'is_rate' => true,
                'is_farm' => false,
                'prorated' => true,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                'vehicle_slug' => $this->slugit('SUV'),
                'begin_weight' => 24000,
                'end_weight' => 37999,
                'fee' => 0.60,
                'per_pound_rate' => 100,
                'is_rate' => true,
                'is_farm' => false,
                'prorated' => true,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                'vehicle_slug' => $this->slugit('SUV'),
                'begin_weight' => 38000,
                'end_weight' => 80000,
                'fee' => 0.63,
                'per_pound_rate' => 100,
                'is_rate' => true,
                'is_farm' => false,
                'prorated' => true,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                'vehicle_slug' => $this->slugit('SUV'),
                'begin_weight' => 80001,
                'end_weight' => 88000,
                'fee' => 0.64,
                'per_pound_rate' => 100,
                'is_rate' => true,
                'is_farm' => false,
                'prorated' => true,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],

            // Is farm options.
            /*[
                'vehicle_slug' => $this->slugit('truck'),
                'begin_weight' => 0,
                'end_weight' => 9999,
                'fee' => 12.00,
                'per_pound_rate' => 0,
                'is_rate' => false,
                'is_farm' => true,
                'prorated' => false,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                'vehicle_slug' => $this->slugit('truck tractor'),
                'begin_weight' => 0,
                'end_weight' => 9999,
                'fee' => 12.00,
                'per_pound_rate' => 0,
                'is_rate' => false,
                'is_farm' => true,
                'prorated' => false,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ]*/
            [
                'vehicle_slug' => $this->slugit('truck'),
                'begin_weight' => 0,
                'end_weight' => 6000,
                'fee' => 3.00,
                'per_pound_rate' => 0,
                'is_rate' => false,
                'is_farm' => true,
                'prorated' => false,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                'vehicle_slug' => $this->slugit('truck'),
                'begin_weight' => 6001,
                'end_weight' => 10000,
                'fee' => 3.00,
                'per_pound_rate' => 0,
                'is_rate' => false,
                'is_farm' => true,
                'prorated' => false,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                'vehicle_slug' => $this->slugit('truck'),
                'begin_weight' => 10001,
                'end_weight' => 23999,
                'fee' => 10.00,
                'per_pound_rate' => 0,
                'is_rate' => false,
                'is_farm' => true,
                'prorated' => false,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                'vehicle_slug' => $this->slugit('truck'),
                'begin_weight' => 24000,
                'end_weight' => 43999,
                'fee' => 20.00,
                'per_pound_rate' => 0,
                'is_rate' => false,
                'is_farm' => true,
                'prorated' => false,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                'vehicle_slug' => $this->slugit('truck'),
                'begin_weight' => 44000,
                'end_weight' => 65999,
                'fee' => 30.00,
                'per_pound_rate' => 0,
                'is_rate' => false,
                'is_farm' => true,
                'prorated' => false,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
            [
                'vehicle_slug' => $this->slugit('truck'),
                'begin_weight' => 66000,
                'end_weight' => 88000,
                'fee' => 12.00,
                'per_pound_rate' => 0,
                'is_rate' => false,
                'is_farm' => true,
                'prorated' => false,
                'start_date' => Carbon::parse('5/1/2014')->format('Y/m/d'),
                'end_date'  => Carbon::parse('12/31/2099')->format('Y/m/d')
            ],
        ];
    }
}
