<?php

namespace Thirty98\API\Texas\Seeders;

use Illuminate\Support\Facades\DB;
use Thirty98\API\General\Entities\APISeeder;
use Thirty98\API\Texas\Seeders\Calculators\BusCityBus;
use Thirty98\API\Texas\Seeders\Calculators\BusMotorBus;
use Thirty98\API\Texas\Seeders\Calculators\BusPrivateBus;
use Thirty98\API\Texas\Seeders\Calculators\MotorcycleAtvTypeVehicle;
use Thirty98\API\Texas\Seeders\Calculators\MotorcycleMiniBike;
use Thirty98\API\Texas\Seeders\Calculators\MotorcycleMoped;
use Thirty98\API\Texas\Seeders\Calculators\MotorcycleMotorcycle;
use Thirty98\API\Texas\Seeders\Calculators\MotorcycleMotorcylce;
use Thirty98\API\Texas\Seeders\Calculators\MotorcycleOffRoadMotorcycle;
use Thirty98\API\Texas\Seeders\Calculators\PassengerPassenger;
use Thirty98\API\Texas\Seeders\Calculators\RecreationalMotorHome;
use Thirty98\API\Texas\Seeders\Calculators\RecreationalTravelTrailer;
use Thirty98\API\Texas\Seeders\Calculators\TrailerTokenTrailer;
use Thirty98\API\Texas\Seeders\Calculators\TrailerTrailer;
use Thirty98\API\Texas\Seeders\Calculators\TrailerUtilityTrailer;
use Thirty98\API\Texas\Seeders\Calculators\Truck12PickupTruck;
use Thirty98\API\Texas\Seeders\Calculators\Truck14PickupTruck;
use Thirty98\API\Texas\Seeders\Calculators\Truck1TonPickupTruck;
use Thirty98\API\Texas\Seeders\Calculators\Truck34PickupTruck;
use Thirty98\API\Texas\Seeders\Calculators\TruckCombinationTruck;
use Thirty98\API\Texas\Seeders\Calculators\TruckPickupTruck1Ton;
use Thirty98\API\Texas\Seeders\Calculators\TruckSUVTruckPlates;
use Thirty98\API\Texas\Seeders\Calculators\TruckTruckTractor;
use Thirty98\API\Texas\Seeders\Calculators\TruckVanTruckPlates;

class FeesStates extends APISeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::transaction(function () {
                $state = DB::table('states')->where('code', 'TX')->first();

                // If state not found, do nothing.
                if (!$state) {
                    return;
                }

                $fees = [
                    (new PassengerPassenger())->fees,
                    (new TruckVanTruckPlates())->fees,
                    (new TruckSUVTruckPlates())->fees,
                    (new Truck14PickupTruck())->fees,
                    (new Truck12PickupTruck())->fees,
                    (new Truck34PickupTruck())->fees,
                    (new Truck1TonPickupTruck())->fees,
                    (new TruckPickupTruck1Ton())->fees,
                    (new TruckTruckTractor())->fees,
                    (new TruckCombinationTruck())->fees,
                    (new BusCityBus())->fees,
                    (new BusPrivateBus())->fees,
                    (new BusMotorBus())->fees,
                    (new MotorcycleMoped())->fees,
                    (new MotorcycleMotorcycle())->fees,
                    (new MotorcycleOffRoadMotorcycle())->fees,
                    (new MotorcycleMiniBike())->fees,
                    (new MotorcycleAtvTypeVehicle())->fees,
                    (new RecreationalMotorHome())->fees,
                    (new RecreationalTravelTrailer())->fees,
                    (new TrailerTokenTrailer())->fees,
                    (new TrailerTrailer())->fees,
                    (new TrailerUtilityTrailer())->fees,
                ];

                foreach ($fees as $fee) {
                    $this->linkFeesStates($state, $fee);
                }
            });
        } catch (\Exception $e) {
            $this->command->error('Unable to link Texas State to its Fields. Error: ' . $e->getMessage());
        }
    }

    /**
     * Link fees and states.
     *
     * @param $state
     * @param $fee
     */
    private function linkFeesStates($state, $fees)
    {
        foreach ($fees as $f) {

            // Get fee.
            $fee = DB::table('fees')->where('name', $f['name'])->first();

            // Do nothing when fee is not found.
            if (!$fee) {
                continue;
            }

            // Do nothing when fee and state is already been linked.
            $isLinked = DB::table('fees_states')->where('state_id', $state->id)->where('fee_id',
                $fee->id)->where('category_type_id', $f['_category_type_id'])->first();

            if ($isLinked) {
                continue;
            }

            $data = [
                'fee_id' => $fee->id,
                'state_id' => $state->id,
                'amount' => $f['_amount'],
                'category_type_id' => $f['_category_type_id']
            ];

            DB::table('fees_states')->insert($data);
        }
    }
}
