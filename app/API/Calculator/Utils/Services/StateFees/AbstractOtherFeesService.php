<?php

namespace Thirty98\API\Calculator\Utils\Services\StateFees;

abstract class AbstractOtherFeesService
{
    protected $vehicle_service;
    protected $vehicle_type;
    protected $type_of_plate;

    public function __construct($vehicle_type, $type_of_plate, $vehicle_service)
    {
        $this->vehicle_service = $vehicle_service;
        $this->vehicle_type = $vehicle_type;
        $this->type_of_plate = $type_of_plate;
    }

    public function getOtherFees()
    {
        return [
            'miscellaneous_fee' => $this->getMiscellaneousFee()
        ];
    }

    abstract protected function getMiscellaneousFee();
}
