<?php

namespace Thirty98\API\Calculator\Utils\Services\StateFees\Louisiana;

use Thirty98\API\Calculator\Utils\Contracts\StateFees\TagAgencyFeeServiceInterface;
use Thirty98\API\Calculator\Utils\Services\StateFees\AbstractTagAgencyFeesService;

class TagAgencyFeesService extends AbstractTagAgencyFeesService implements TagAgencyFeeServiceInterface
{
    protected $state = 'LA';

    public function __construct($vehicle_type, $type_of_plate, $vehicle_service)
    {
        parent::__construct($vehicle_type, $type_of_plate, $vehicle_service);
    }

    public function getTagAgencyFees()
    {
        return parent::getTagAgencyFees();
    }

    public function getConvenienceFee()
    {
        return $this->vehicle_service->getVehicleFeeByState($this->state, $this->vehicle_type, 'convenience_fee');
    }

    public function getProcessingFee()
    {
        return $this->vehicle_service->getVehicleFeeByState($this->state, $this->vehicle_type, 'processing_fee');
    }

    public function getMailFee()
    {
        return $this->vehicle_service->getVehicleFeeByState($this->state, $this->vehicle_type, 'mail_fee');
    }

    public function getElectronicFilingFee()
    {
        if ($this->type_of_plate != "DT" &&$this->type_of_plate != "TRC") {
            return $this->vehicle_service->getVehicleFeeByState($this->state, $this->vehicle_type, 'electronic_filing_fee');
        } else {
            return 0;
        }
    }
}
