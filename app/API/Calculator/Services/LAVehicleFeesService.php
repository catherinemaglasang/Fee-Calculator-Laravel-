<?php

namespace Thirty98\API\Calculator\Services;

class LAVehicleFeesService
{

    /**
     * For Car, Van and SUVs having a gvwr of less than 10000.
     * @param $fee
     */
    public function getPassengerVehicleLicenseFee($fee)
    {
        return (round( ($fee - 10000) * .001 ) * 2) + 20;
    }

    public function getWeightedCalculation($state, $vehicleType, $dateOfSale, $gcvwr)
    {
        // Get vehicle type rate.
        $db = LALicenseWeightFee::join('state_vehicle_types', 'state_vehicle_types.id', '=', 'state_vehicle_type_id')
            ->join('vehicle_types', 'vehicle_types.id', '=', 'state_vehicle_types.vehicle_type_id')
            ->where('vehicle_types.name', $vehicleType)
            ->where('state_vehicle_types.state_code', $state)
            ->whereRaw("$gcvwr BETWEEN start_date AND end_date")
            ->havingRaw('now() BETWEEN start_date AND end_date')
            ->first();

        if (!$db) {
            return "No Fee Found.";
        }

        $is_rate = $db['is_rate'];
        $per_pound_rate = $db['per_pound_rate'];
        $is_farm = $db['is_farm'];
        $prorated = $db['prorated'];
        $fee = $db['fee'];
        $prorationMonth = $db['proration_month'];

        if ($is_farm) {
            return $fee;
        } else {
            if ($prorated && $is_rate) {
                $date = strtotime($dateOfSale);

                if ($date) {
                    $month = date('m', $date);
                } else {
                    return "Bad date format.";
                }

                $prorateMonth = date('m', strtotime($prorationMonth));

                // Check if july has elapsed.
                if ($month >= $prorateMonth) {
                    $licenseMultiplier = (12 - $month) + $prorateMonth;
                } else {
                    $licenseMultiplier = $prorateMonth - $month;
                }

                $licenseFee = $gcvwr * ($fee / $per_pound_rate);
                $licenseFee = ($licenseFee / 12) * $licenseMultiplier;

                return $licenseFee;
            } else {
                return $fee;
            }
        }
    }

    /**
     * End of Louisiana Calculations.
     */
}