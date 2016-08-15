<?php

namespace Thirty98\API\Calculator\Services\Configurations\Fields\States\Texas;

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
class TexasVehicleTypeFilter
{
    protected $farm_use_vehicles = [
        "van_truck_plates",
        "suv_truck_plates",
        "1_4_pickup_truck",
        "1_2_pickup_truck",
        "3_4_pickup_truck",
        "1_ton_pickup_truck",
        "pickup_truck_1_ton",
        "truck_tractor",
        "commercial_truck",
        "trailer"
    ];

    protected $weighted_vehicles = [

    ];

    protected $preselected_off_road_vehicles = [
        "mini_bike",
        "off_road_motorcycle",
        "atv_type_vehicle"
    ];

    protected $weight_form_fields = [
        'empty_weight' => [
            "name" => "empty_weight",
            "title" => "Empty Weight",
            "required" => true,
            'display_order' => 10
        ],
        'trailer_weight' => [
            "name" => "trailer_weight",
            "title" => "Trailer Weight",
            "required" => false,
            'display_order' => 11
        ],
        'carrying_capacity' => [
            "name" => "carrying_capacity",
            "title" => "Carrying Capacity",
            "required" => false,
            'display_order' => 12
        ],
        'gvw' => [
            "name" => "gvw",
            "title" => "GVW",
            "required" => true,
            'display_order' => 13
        ],
        'gvwr' => [
            "name" => "gvwr",
            "title" => "GVWR",
            "required" => true,
            'display_order' => 14
        ]
    ];

    public function filter($master_fields, $payload)
    {
        $transaction_type = RequestHelperService::ifMultiIndexParam($payload['transaction_type'], true);
        $vehicle_type = $payload['vehicle_type']['slug'];
        $master_fields['form_fields'] = array_values($master_fields['form_fields']);
        $master_fields['calculator_options'] = array_values($master_fields['calculator_options']);

        /**
         * van truck plates (van_truck_plates)
         * suv truck plates (suv_truck_plates)
         * 1/4 pickup truck (1_4_pickup_truck)
         * 1/2 pickup truck (1_2_pickup_truck)
         * 3/4 pickup truck (3_4_pickup_truck)
         * 1 ton pickup truck (1_ton_pickup_truck)
         * pickup Truckt > 1 Ton (pickup_truck_1_ton)
         * Truck Tractor (truck_tractor)
         * Combination truck (commercial_truck)
         * Trailer (trailer)
         *
         */

        // Farm use.
        if (in_array($vehicle_type, $this->farm_use_vehicles)) {
            // Add farm use in options
            $insert_data = [
                ['name' => "farm_use", "title" => "Farm Use?", "selected" => false, "display_order" => 4]
            ];

            $master_fields['calculator_options'] = ArrayHelperService::insertBetweenIndex(1, $insert_data, $master_fields['calculator_options']);
        }

        // Off Road vehicle.
        if (in_array($vehicle_type, $this->preselected_off_road_vehicles)) {
            $option_index = ArrayHelperService::findArrayByKey($master_fields['calculator_options'], 'off_highway_use');

            $master_fields['calculator_options'][$option_index]['selected'] = true;
        }

        return $master_fields;
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