<?php

namespace Thirty98\API\Avalara\Services;

use Thirty98\API\Avalara\Models\Avalara;

class AvalaraService
{
    protected $model;
    
    public function __construct(Avalara $model)
    {
        $this->model = $model;
    }
    
    public function getLocation($street_address, $zipcode)
    {
        $location = $this->model->verifyLocation($street_address, $zipcode);
        
        if (!is_array($location)){
            return [
                'error' => [
                    'http_code'     => 200,
                    'response_msg'  => "No data found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception"     => "There's something wrong with your request. Please try again"
                ]
            ];
        }
        
        unset($location['ResultCode']);
        
        return $location;
    }
}