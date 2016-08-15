<?php

namespace Thirty98\API\Calculator\Services\Configurations\Fields\States\Louisiana;

use DB;
use Thirty98\API\Calculator\Services\TransactionTypeService;
use Thirty98\API\Stdlib\Services\StateService;
use Thirty98\API\Vehicle\Services\VehicleService;

class LouisianaStateData
{
    protected $master_fields = [];
    protected $ttl_service;
    protected $vehicle_service;
    protected $state;

    public function __construct(TransactionTypeService $ttl_service, StateService $state, VehicleService $vehicle_service)
    {
        $this->ttl_service = $ttl_service;
        $this->vehicle_service = $vehicle_service;
        $this->state = $state;
    }

    public function filter($master_fields, $payload)
    {
        $state = $payload['state']['code'];

        // Default vehicle type is car.
        $vehicle_type = isset($payload['vehicle_type']['slug']) ? $payload['vehicle_type']['slug'] : "car";

        $this->master_fields = $master_fields;

        foreach ($this->master_fields['form_fields'] as $key => $form_field) {
            $form_field_name = $form_field['name'];

            /**
             * Configure field types.
             */
            switch ($form_field_name) {
                case "transaction_type":
                    $this->master_fields['form_fields'][$key]['data'] = $this->getTransactionTypes($state);
                    break;
                case "vehicle_type":
                    $this->master_fields['form_fields'][$key]['data'] = $this->getVehicleTypes($state);
                    break;
                case "type_of_plate":
                    $this->master_fields['form_fields'][$key]['data'] = $this->getPlateTypes($state, $vehicle_type);
                    break;
                case "model_year":
                    $this->master_fields['form_fields'][$key]['data'] = $this->getModelYear();
                    break;
                case "mortgage_fee":
                    $this->master_fields['form_fields'][$key]['data'] = $this->getMortgageFee();
                    break;
                case "county":
                    $this->master_fields['form_fields'][$key]['data'] = $this->getCounties($state);
                    break;
                case "city_limits":
                    $this->master_fields['form_fields'][$key]['data'] = $this->getCityLimits($state);
                    break;
                default:
                    break;
            }
        }

        /*$this->master_fields['counties'] = $this->getCounties($state);
        $this->master_fields['transaction_types']  = $this->getTransactionTypes($state);
        $this->master_fields['vehicle_types']  = $this->getVehicleTypes($state);*/

        return $this->master_fields;
    }

    protected function getCounties($state)
    {
        return $this->state->getCountiesByState($state);
    }

    private function getTransactionTypes($state)
    {
        return $this->ttl_service->getTransactionTypesByState($state);
    }

    private function getVehicleTypes($state)
    {
        return $this->state->getVehicleTypes($state);
    }

    private function getPlateTypes($state, $vehicle_type)
    {
        return $this->vehicle_service->fetchPlateByStateAndVehicleType($state, $vehicle_type);
    }

    private function getModelYear()
    {
        $year_start = 1900;
        $year_end = date('Y') + 2;

        $years = [];

        for ($i = $year_end; $i > ($year_start - 1); $i--) {
            $years[] = [
                "name" => $i,
                "value" => $i
            ];
        }

        return $years;
    }

    private function getMortgageFee()
    {
        return [
            [
                "name" => 'UCC-1 = $15.00',
                "value" => 15
            ],
            [
                "name" => 'Non UCC-1 = $10.00',
                "value" => 10
            ],
            [
                "name" => 'No Lender = $0.00',
                "value" => 0
            ],
        ];
    }

    private function getCityLimits()
    {
        return [
            [
                'display_name' => 'Yes',
                'name' => 'city_limits',
                'value' => true
            ],
            [
                'display_name' => 'No',
                'name' => '',
                'value' => false
            ],
        ];
    }
}