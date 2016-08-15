<?php

namespace Thirty98\API\Calculator\Services\Configurations\Fields\States\Louisiana;

use Thirty98\API\Stdlib\Helpers\ArrayHelperService;
use Thirty98\API\Stdlib\Helpers\RequestHelperService;


/**
 * Reminders:
 * 1. We have already filtered entries based on transaction type, whether this field is required or NOT.
 * 2. This is a further filtering of the fields already filtered, some changes we require is what fields are shown and/or required.
 * 3. An example would be the vehicle {private_bus} with a plate type of {hire_passenger_plate}, this requires the form field "number of passenger" to be required AND included (as it is not included)
 *
 * Notes to remember
 * 1. Angular will determine which fields should be shown
 * 2. Backend configuration determines which fees are required.
 * 3. Angular and Backend Configuration should be SYNCED - display those required, hire those who aren't.
 * Class LouisianaVehicleTypeFilter
 * @package Thirty98\API\Calculator\Services\Configurations\Fields\States\Louisiana
 */
class LouisianaVehicleTypeFilter
{
    protected $master_fields = [];

    protected $regular_vehicles = [
        "car",
        "van",
        "suv",
        "antique_vehicle",
        "motor_home",
        "motorcycle",
        "off_road_vehicle",
        "trailer",
        "travel_trailer",
        "semi_trailer"
    ];

    protected $truck_vehicles = [
        "truck",
        "truck_tractor"
    ];

    protected $boat_vehicles = [
        "boat_trailer",
        "utility_trailer"
    ];

    protected $form_fields = [
        "number_of_passengers" => ["name" => "number_of_passengers", "title" => "No of Passengers?", "required" => true, 'display_order' => 11, 'field_type' => 'input'],
        "empty_weight" => ["name" => "empty_weight", "title" => "Empty Weight", "required" => true, 'display_order' => 12, 'field_type' => 'input'],
        "trailer_weight" => ["name" => "trailer_weight", "title" => "Trailer Weight", "required" => true, 'display_order' => 13, 'field_type' => 'input'],
        "carrying_capacity" => ["name" => "carrying_capacity", "title" => "Carrying Capacity", "required" => false, 'display_order' => 14, 'field_type' => 'input'],
        "gvw" => ["name" => "gvw", "title" => "GCVW", "required" => true, 'display_order' => 15, 'field_type' => 'input'],
        "gvwr" => ["name" => "gvwr", "title" => "GVWR", "required" => true, 'display_order' => 16, 'field_type' => 'input'],
    ];

    protected $option_fields = [
        "farm_use" => ['name' => "farm_use", "title" => "Farm Use?", "default" => false, 'display_order' => 3],
        "did_pull_a_trailer" =>  ['name' => "did_pull_a_trailer", "title" => "Do you ever pull a Trailer?", "selected" => false, 'display_order' => 4],
    ];

    public function filter($master_fields, $payload)
    {
        if(!isset($payload['vehicle_type']['slug'])) {
            return $master_fields;
        }

        $this->master_fields = $master_fields;

        $transaction_type = RequestHelperService::ifMultiIndexParam($payload['transaction_type'], true);
        $vehicle_type = $payload['vehicle_type']['slug'];
        $master_fields['form_fields'] = array_values($master_fields['form_fields']);

        // If this is the field, just return the $master_fields (because they are already formatted to what they are needed)
        $regular_vehicles = ["car", "van", "suv", "antique_vehicle", "motor_home", "motorcycle", "off_road_vehicle", "trailer", "travel_trailer", "semi_trailer"];

        // Special vehicle rules.
        $truck_vehicles = ["truck", "truck_tractor"];
        $boat_vehicles = ["boat_trailer", "utility_trailer"];

        $type_of_plate = RequestHelperService::ifParam($payload, 'type_of_plate', true);

        if (in_array($vehicle_type, $this->regular_vehicles)) {
            // Just return fields filtered by transaction type if regular vehicles.
            return $master_fields;
        } else if (in_array($vehicle_type, $this->truck_vehicles)) {
            // Add farm use in options
            array_push($this->master_fields['calculator_options'], $this->option_fields['farm_use']);


            if ($transaction_type === "NR" || $transaction_type === "TP") {
                // Add option field do you ever pull a trailer.
                // Add form fields empty_weight, carrying capacity, gvw and gvwr.
                // To possibly add other fields in the checkbox options.
                array_push($this->master_fields['calculator_options'], $this->option_fields['did_pull_a_trailer']);

                array_push($this->master_fields['form_fields'], $this->form_fields['empty_weight']);
                array_push($this->master_fields['form_fields'], $this->form_fields['carrying_capacity']);
                array_push($this->master_fields['form_fields'], $this->form_fields['gvw']);
                array_push($this->master_fields['form_fields'], $this->form_fields['gvwr']);
            }
        } else if ($vehicle_type === 'private_bus') {
            // If plate type is hire passenger plate add form field number of passengers.
            /*if ($type_of_plate == 'hire_passenger_plate') {
                array_push($this->master_fields['form_fields'], $this->form_fields['number_of_passengers']);
            }*/

            if($type_of_plate == false && $type_of_plate !== "hire_passenger_plate") {
                array_push($this->master_fields['form_fields'], $this->form_fields['number_of_passengers']);
            }
        } else if (in_array($vehicle_type, $this->boat_vehicles)) {
            // If these special boat vehicles, add did you pull a trailer BUT it is already selected.
            // Add form field trailer weight and set to required.
            if ($transaction_type === "NR" || $transaction_type === "TP") {
                array_push($this->master_fields['calculator_options'], $this->option_fields['did_pull_a_trailer']);

                array_push($this->master_fields['form_fields'], $this->form_fields['empty_weight']);
                array_push($this->master_fields['form_fields'], $this->form_fields['trailer_weight']);
                array_push($this->master_fields['form_fields'], $this->form_fields['carrying_capacity']);
                array_push($this->master_fields['form_fields'], $this->form_fields['gvw']);
                array_push($this->master_fields['form_fields'], $this->form_fields['gvwr']);
            }
        }

        return $this->master_fields;
    }


    /**
     * Vehicle type filter settings.
     * Further filters state fields based on their vehicle type (required or not required)
     *
     * @return array
     */
    public function getVehicleTypeFields()
    {
        return [
            'form_fields' => [
                // Normal form fields for louisiana.
                "car" => [
                    // Return all fields with weight columns.
                    // Weight columns not required.
                ],
                "van" => [

                ],
                "suv" => [

                ],
                "truck" => [

                ],
                "antique_vehicle" => [

                ],
                "truck_tractor" => [

                ],
                "private_bus" => [

                ],
                "motor_home" => [

                ],
                "motorcycle" => [

                ],
                "off_road_vehicle" => [

                ],
                "trailer" => [

                ],
                "utility_trailer" => [

                ],
                "travel_trailer" => [

                ],
                "semi_trailer" => [

                ],
                "boat_trailer" => [

                ],

            ],
            'calculator_options' => [
                "general" => [

                ]
            ]
        ];
    }

    /**
     * These are the common vehicle types used by most vehicles.
     * @return array
     */
    public function getGeneralVehicleTypeFields()
    {
        /**
         * Tips
         * 1. Fields can be returned, but the may/may not be required
         * 2. Trucks/Truck Tractor require empty weight, carrying_capacity, and may also require a trialer weight in order to populate gcvw,
         * 3. Trucks/Truck Tractor have an option of Farm USE and do you pull a trailer: If checked, trailer weight is required, it not it's not sent, AND not required
         * 4. Private bus with plate type of private bus plate has a required field number_of_passengers
         * 5. Utility Trailer has do you ever pull a trailer marked as SELECTED, and has empty weight and trailer weight with it.
         * 6.
         */

        /**
         * General Vehicle Type Enumeration:
         *
         * transaction_type,
         * vin,
         * vehicle_type,
         * type_of_plate,
         * model_year,
         * mortgage_fee,
         * street_address,
         * zip,
         * city_limits,
         * sales_prices,
         * rebate_discount,
         * trade_in_value,
         * taxable_value,
         * date_of_sale
         */

        /**
         * Special Vehicle Fields:
         *
         */
        return [

        ];
    }

    /**
     * These are the common calculator option fields used by most vehicles.
     * @return array
     */
    public function getGeneralCalculatorOptionFields()
    {
        return [

        ];
    }
}