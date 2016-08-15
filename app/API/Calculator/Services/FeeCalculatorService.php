<?php

namespace Thirty98\API\Calculator\Services;

use Carbon\Carbon;
use Thirty98\API\Vehicle\Services\VehicleService;
use Thirty98\Models\FeeCalculatorLog;

class FeeCalculatorService
{
    /**
     * Initialize the Rules and Configuration for the Calculation
     *
     * @param string $state
     */
    public function inititialize($state)
    {

    }

    public function calculate(Array $payload)
    {
        $state = str_replace(" ", "", ucwords($payload['state']['name']));
        $type  = str_replace(" ", "", ucwords($payload['vehicles']['class']));
        $class = "Thirty98\\API\\Calculator\\Controllers\\VehiclePlugins\\".$state."\\".$type;

        if (!class_exists($class)) {
            return [
                'error' => [
                    'http_code'     => 200,
                    'response_msg'  => "Cannot initiate calculator instance.",
                    'response_code' => "CALCULATOR_NOT_FOUND",
                    "exception"     => "Class for '". $payload['state']['name'] . " of type " . $type ."' not found"
                ]
            ];
        }

        $calculator = new $class();

        //Override Sales Tax Computations in TX
        if ($payload['state']['code'] == "TX") {
            $payload['calc_config']['new_registration_tax'] = $payload['new_registration_tax'];
            $payload['calc_config']['even_trade_tax']       = $payload['even_trade_tax'];
            $payload['calc_config']['sales_tax']            = $payload['sales_tax'];
            $payload['calc_config']['gift_tax']             = $payload['gift_tax'];
        }

        /**
         * @todo Include Dealers Configuration
         */
        $calculator->setConfig($payload['calc_config'], $payload, $payload['fee_rates']);

        if (method_exists($calculator, "setVehicleService")) {
            $calculator->setVehicleService(new VehicleService());
        }

        return $calculator->getTotal();
    }

    public function add_log(Array $payload)
    {
        $insert_id = FeeCalculatorLog::insertGetId([
            'state_code' => $payload['state_code'],
            'log_params' => $payload['log_params'],
            'status'     => $payload['status'],
            'date_added' => Carbon::now()
        ]);

        if(!is_numeric($insert_id)) {
            return [
                'error' => [
                    'http_code'     => 200,
                    'response_msg'  => "Log Insert Failed.",
                    'response_code' => "LOG_INSERT_FAILED",
                    "exception"     => "Log insert failed."
                ]
            ];
        }

        return $insert_id;
    }
}