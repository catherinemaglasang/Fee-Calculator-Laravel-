<?php

namespace Thirty98\API\POS\Middleware;

use Thirty98\API\Stdlib\Middleware\AbstractPostMiddleware;
use Thirty98\API\POS\Services\POSService;

class POSMiddleware extends AbstractPostMiddleware
{
    protected $pos_service;
    protected $vehicle_service;
    protected $pos_plate_type;


    public function __construct(POSService $pos_service)
    {
        $this->pos_service = $pos_service;
    }

    protected function updateRequest(Array $payload)
    {
        if ($payload['state']['code'] === "LA") {

            if (isset($this->pos_plate_type['error'])) {
                return $this->pos_plate_type;
            }

            $gvw = $this->payload['gvw'];

            if ($this->payload['vehicle_type']['slug'] === "truck" && $gvw > 88000) {
                return [
                    'error' => [
                        'http_code' => 200,
                        'response_msg' => "GVW exceeds farm truck vehicles.",
                        'response_code' => "VALIDATION_ERROR",
                        "exception" => "GVW '{$gvw}' exceeds the allowed weight of truck vehicles."
                    ]
                ];
            }

            if ($this->pos_plate_type['slug'] != $payload['vehicle_type']['slug']) {
                return [
                    'error' => [
                        'http_code' => 200,
                        'response_msg' => "Vehicle Type and Class Code Mismatch",
                        'response_code' => "DATA_MISMATCH",
                        "exception" => "Data mismatch for class code '{$payload['pos_class_code']}' and vehicle type: '{$payload['vehicle_type']['slug']}'"
                    ]
                ];
            }

            $payload['pos_plate_calculation_rules'] = $this->pos_plate_type->toArray();
        }

        switch ($payload['vehicle_type']['slug']) {
            case "car":
                $payload['type_of_plate'] = "car_plate";

                if ($payload['pos_name'] === "0103-Car-Commercial-2 YR") {
                    $payload['pos_plate_calculation_rules']['staggered'] = $payload['pos_plate_calculation_rules']['staggered'] * 2;
                }
                break;
            case "truck":
                if ($payload['pos_plate_calculation_rules']['prefix'] === "F" || $payload['pos_plate_calculation_rules']['prefix'] === "HF") {
                    $payload['farm_use'] = true;
                    $payload['type_of_plate'] = "farm_plate";
                } else {
                    $payload['farm_use'] = false;
                    $payload['type_of_plate'] = "truck_plate";
                }
                break;
            case "bus":
                if ($this->pos_plate_type['per_passenger'] != 0) {
                    $payload['type_of_plate'] = "hire_passenger_plate";
                } else {
                    $payload['type_of_plate'] = "private_bus_plate";
                }
                break;
            case "trailer":
                $payload['type_of_plate'] = "1_yr_trailer_plate";
                break;
            case "motorcycle":
                $payload['type_of_plate'] = "motorcycle_plate";
                break;
        }

        return $payload;
    }

    protected function postValidationRules()
    {
        $validations = [
            'pos_class_code' => 'required|string',
            "pos_name" => "required|string"
        ];

        if ($this->payload['vehicle_type']['slug'] === "truck" || $this->payload['vehicle_type']['slug'] === "trailer") {
            $validations['farm_use'] = 'required|boolean';
        }

        if ($this->payload['vehicle_type']['slug'] === "truck") {
            $validations['farm_use'] = 'required|boolean';
            $validations['gvw'] = "required|numeric";
        }

        $this->pos_plate_type = $this->pos_service->getPOSPlateData($this->payload['pos_class_code']);

        // dd($this->pos_plate_type);

        if (isset($this->pos_plate_type['error'])) {
            return $this->pos_plate_type;
        }

        if ($this->pos_plate_type['per_passenger'] != 0) {
            $validations['number_of_passengers'] = 'required|integer';
        }

        return $validations;
    }
}
