<?php

namespace Thirty98\API\Calculator\Services\Configurations\Fields\States\Arkansas;

use Thirty98\API\Stdlib\Helpers\ArrayHelperService;
use Thirty98\API\Stdlib\Helpers\RequestHelperService;


class ArkansasVehicleTypeFilter
{
    protected $farm_use_vehicles = [
        "1_2_pickup_van",
        "3_4_pickup_van",
        "1_ton_pickup_van",
        "1_2_pickup_truck",
        "3_4_pickup_truck",
        "1_ton_pickup_truck"
    ];

    protected $off_road_motorcycle_vehicles = [
        "moped",
        "motorcycle",
        "motorcycle_side_car",
        "off_road_motorcycle",
        "atv_type_vehicle",
        "motorized_bike_standard",
        "motorized_bike_automatic"
    ];

    protected $option_fields = [
        "farm_use" => ['name' => "farm_use", "title" => "Farm Use?", "selected" => false, "display_order" => 6],
        "off_road_motorcycle" => ['name' => "off_road_motorcycle", "title" => "Off-Road Motorcycle", "selected" => false, "display_order" => 7]
    ];

    public function filter($master_fields, $payload)
    {
        $vehicle_type = $payload['vehicle_type']['slug'];

        // Farm use vehicles.
        if (in_array($vehicle_type, $this->farm_use_vehicles)) {
            array_push($master_fields['calculator_options'], $this->option_fields["farm_use"]);
        }

        // Off Road Motorcycles.
        if (in_array($vehicle_type, $this->off_road_motorcycle_vehicles)) {
            array_push($master_fields['calculator_options'], $this->option_fields["off_road_motorcycle"]);
        }

        return $master_fields;
    }


}