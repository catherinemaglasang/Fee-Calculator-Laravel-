<?php

namespace Thirty98\API\Calculator\Utils\Services\StateFees\Louisiana;

use Thirty98\API\Calculator\Utils\Contracts\StateFees\TitleFeeServiceInterface;
use Thirty98\API\Calculator\Utils\Services\StateFees\AbstractStateTitleFeesService;

class TitleFeesService extends AbstractStateTitleFeesService implements TitleFeeServiceInterface
{
    protected $state = 'LA';

    public function __construct($vehicle_type, $type_of_plate, $vehicle_service)
    {
        parent::__construct($vehicle_type, $type_of_plate, $vehicle_service);
    }

    public function getTitleFees()
    {
        $title_fees = parent::getTitleFees();
        $title_fees['title_correction_fee'] = $this->getTitleCorrectionFee();
        
        return $title_fees;
    }

    protected function getTitleFee()
    {
        if ($this->type_of_plate == "DT") {
            return 0;
        }
        
        return $this->vehicle_service->getVehicleFeeByState($this->state, $this->vehicle_type, 'title_fee');
    }

    protected function getDuplicateTitleFee()
    {
        if ($this->type_of_plate != "DT") {
            return 0;
            
        }
        
        return $this->vehicle_service->getVehicleFeeByState($this->state, $this->vehicle_type, 'duplicate_title_fee');
    }

    protected function getTitleCorrectionFee()
    {
        if ($this->type_of_plate != "TRC") {
            return 0;
        }
        
        return $this->vehicle_service->getVehicleFeeByState($this->state, $this->vehicle_type, 'title_correction_fee');
    }
}
