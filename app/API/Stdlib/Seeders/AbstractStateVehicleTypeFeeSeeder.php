<?php

namespace Thirty98\API\Stdlib\Seeders;

use Illuminate\Support\Facades\DB;
use Thirty98\Models\Fee;
use Thirty98\Models\StateVehicleFee;
use Thirty98\Models\StateVehicleType;
use Thirty98\Models\VehicleType;

class AbstractStateVehicleTypeFeeSeeder extends AbstractDatabaseSeeder
{
    /**
        To check use the ff query:
        SELECT
            svt.state_code,
            vt.name,
            f.name,
            svtf.amount,
            svtf.start_date,
            svtf.end_date
        FROM
            state_vehicle_type_fees svtf
                INNER JOIN state_vehicle_types svt
                    ON svt.id = svtf.state_vehicle_type_id
                INNER JOIN state_vehicle_fees svf
                    ON svf.id = svtf.state_vehicle_fee_id
                INNER JOIN vehicle_types vt
                    ON vt.id = svt.vehicle_type_id
                INNER JOIN fees f
                    ON f.id = svf.fee_id

     */
    protected function executeSeeder()
    {
        $vehicleTypes = VehicleType::all();
        $vehicleTypeIndexes = [];

        $fees = Fee::all();
        $feesIndexes = [];

        $vehicleFeesState = StateVehicleFee::where('state_code', $this->state_code)->get();
        $vehicleFeesStateIndexes = [];

        $vehicleTypesState = StateVehicleType::where('state_code', $this->state_code)->get();
        $vehicleTypeStateIndexes = [];

        // Build indexes for fast insert.
        foreach ($vehicleTypes as $key => $value) {
            $vehicleTypeIndexes[$value['slug']] = $value['id'];
        }

        foreach ($fees as $key => $value) {
            $feesIndexes[$value['slug']] = $value['id'];
        }

        foreach ($vehicleFeesState as $key => $value) {
            $vehicleFeesStateIndexes[$value['fee_id']][$this->state_code] = $value['id'];
        }

        foreach ($vehicleTypesState as $key => $value) {
            $vehicleTypeStateIndexes[$value['vehicle_type_id']][$this->state_code] = $value['id'];
        }

        foreach ($this->getStateVehicleTypeFees() as $data) {
            $vehicleID = $vehicleTypeIndexes[$data['vehicle_slug']];
            $fees = $data['fees'];

            foreach ($fees as $fee) {

                $feeID = $feesIndexes[$fee['fee_slug']];

                $amount = $fee['amount'];
                $start_date = $fee['start_date'];
                $end_date = $fee['end_date'];

                $feeIDLouisiana = $vehicleFeesStateIndexes[$feeID][$this->state_code];
                $vehicleTypeIDLouisiana = $vehicleTypeStateIndexes[$vehicleID][$this->state_code];

                // Check if fee is already existing.
                $exists = DB::table($this->table_name)->where('state_vehicle_type_id', $vehicleTypeIDLouisiana)
                    ->where('state_vehicle_fee_id', $feeIDLouisiana)
                    ->where('amount', $amount)
                    ->where('start_date', $start_date)
                    ->where('end_date', $end_date)
                    ->first();

                if (!$exists) {
                    $result = DB::table($this->table_name)->insertGetId([
                        'state_vehicle_type_id' => $vehicleTypeIDLouisiana,
                        'state_vehicle_fee_id' => $feeIDLouisiana,
                        'amount' => $amount,
                        'start_date' => $start_date,
                        'end_date' => $end_date
                    ]);

                    if(!is_numeric($result)) { die('State Vehicle Type Fee Insert Failed.'); }
                }
            }
        }
    }
}
