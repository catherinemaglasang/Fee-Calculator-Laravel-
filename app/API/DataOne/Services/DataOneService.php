<?php

namespace Thirty98\API\DataOne\Services;

use Thirty98\API\DataOne\Models\DataOne;
use Slugifier;

class DataOneService
{
    protected $model;
    
    public function __construct(DataOne $model)
    {
        $this->model = $model;
    }
    
    /**
     * Get vehicle details by VIN
     * 
     * @param string $vin
     * @return Model
     */
    public function getVehicleInfo($vin)
    {
        $vehicles =  $this->model->where('vin_pattern', $this->getVinPattern($vin))->get();
        
        $data =  $vehicles->toArray();
        
        if(count($data) == 0) {
            return [
                'error' => [
                    'http_code'     => 200,
                    'response_msg'  => "No data found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception"     => "No corresponding vehicle for the particular vin: {$vin}"
                ]
            ];
        }
        
        return $data;
    }
    
    /**
     * 
     * @param string $vin
     * @return string
     */
    public function getVinPattern($vin)
    {
        return substr($vin, 0, 8) . substr($vin, 9, 2);
    }
    
    public function getVehicleStyles()
    {
        $data = $this->model->distinct()->select("body_type", "body_subtype", "style")->get();
        
        if(count($data) == 0) {
            return [
                'error' => [
                    'http_code'     => 200,
                    'response_msg'  => "No data found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception"     => "No corresponding body types"
                ]
            ];
        }
        
        return json_decode(json_encode($data), true);
    }


    public function mappingCorrections(Array $vehicles)
    {
        $data = [];
        // For multiple records
        foreach ($vehicles as $vehicle) {
            
            $gvw = $this->getGrossVehicleWeight(
                    Slugifier::slugify($vehicle['vehicle_type'], "_"),
                    $vehicle['curb_weight'],
                    $vehicle['tonnage'],
                    $vehicle['body_subtype']
            );
            
            $data[$vehicle['vehicle_id']] = $vehicle;
            $data[$vehicle['vehicle_id']]['model_year'] = $vehicle['year'];
            $data[$vehicle['vehicle_id']]['vehicle_type'] = $vehicle['vehicle_type']; //should be mapped to correct vehicle type by State
            $data[$vehicle['vehicle_id']]['vehicle_slug'] = Slugifier::slugify($vehicle['vehicle_type'], "_");           
            $data[$vehicle['vehicle_id']]['gvwr'] = $vehicle['gross_vehicle_weight_rating'];
            $data[$vehicle['vehicle_id']]['carrying_capacity'] = $vehicle['tonnage'] * 2000;
            $data[$vehicle['vehicle_id']]['gvw'] = $gvw;   
            $data[$vehicle['vehicle_id']]['curb_weight'] = ceil($vehicle['curb_weight'] / 100) * 100; //Rounding Rules
        }
        
        return (Array) $data;
    }
    
    
    public function correctVehicleTypeMapping(Array $data, $state)
    {   
        $updated = [];
        foreach ($data AS $vehicle) {
            $vehicle['vehicle_type'] = $this->dataOneStateMapping($state, $vehicle);
            $vehicle['vehicle_slug'] = Slugifier::slugify($vehicle['vehicle_type'], "_");
            $vehicle['fuel_type'] = $this->correctFuelType($state, $vehicle['fuel_type']);
            $updated[$vehicle['style']] = $vehicle;
        }
        
        return (Array) $updated;
    }
    
    
    /**
     * DataOne State Correction Mapping
     * 
     * @param type $state
     * @param type $vehicle
     * @return string
     */
    protected function dataOneStateMapping($state, $vehicle)
    {
        if ($state === "TX") {
            switch(strtolower($vehicle['vehicle_type'])) {
                case "car": return "Passenger";
                case "van": {
                    if (strtolower($vehicle['body_subtype']) === "passenger")
                        return "Passenger";
                    if (strtolower($vehicle['body_subtype']) === "extended length passenger")
                        return "Passenger";
                    if (strtolower($vehicle['body_subtype']) === "cargo")
                        return "Van Truck Plates";
                    if (strtolower($vehicle['body_subtype']) === "extended length cargo")
                        return "Van Truck Plates";
                }
                case "suv": return "suv_truck_plates";
                case "truck": {
                    if ($vehicle['tonnage'] > 1) {
                        return "Pickup Truck > 1 Ton";
                    }
                    if ($vehicle['tonnage'] == 1) {
                        return "1 Ton Pickup Truck";
                    }
                    if ($vehicle['tonnage'] == 0.75) {
                        return "3/4 Pickup Truck";
                    }
                    if ($vehicle['tonnage'] == 0.50) {
                        return "1/2 Pickup Truck";
                    }
                    if ($vehicle['tonnage'] == 0.25) {
                        return "1/4 Pickup Truck";
                    }
                }
            }
        }
        
        return $vehicle['vehicle_type'];
    }
    
    private function getGrossVehicleWeight($vehicle_type, $crub_weight, $tonnage, $body_subtype = "")
    {
        $gvw = 0;
        $cw = intval($crub_weight / 100) * 100 + 100;
        
        switch (strtolower($vehicle_type)) {
            case "truck": {
                 $gvw = $cw + ($tonnage * 2000);
                 break;
            }
            case "car": {
                $gvw = $cw + 100;
                break;
            }
            case "van": {
                if (strtolower($body_subtype) === 'cargo') {
                    $gvw = $cw + ($tonnage * 2000);
                } else {
                    $gvw = $cw + 100;
                }
                break;
            }
        }
        
        return intval($gvw);
    }
    
    private function correctFuelType($state, $fuel_type)
    {
        if ($fuel_type != "G") {
            return "D";
        }

        return $fuel_type;
        
    }
}
