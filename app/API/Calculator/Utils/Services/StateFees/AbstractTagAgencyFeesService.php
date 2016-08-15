<?php

namespace Thirty98\API\Calculator\Utils\Services\StateFees;


abstract class AbstractTagAgencyFeesService
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

    public function getTagAgencyFees()
    {
        return [
            'convenience_fee' => $this->getConvenienceFee(),
            'processing_fee' => $this->getProcessingFee(),
            'mail_fee' => $this->getMailFee(),
            'electronic_filing_fee' => $this->getElectronicFilingFee(),
        ];
    }
}
