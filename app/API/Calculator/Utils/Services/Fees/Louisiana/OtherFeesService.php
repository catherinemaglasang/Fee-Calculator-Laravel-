<?php

namespace Thirty98\API\Calculator\Utils\Services\StateFees\Louisiana;

use Thirty98\API\Calculator\Utils\Contracts\StateFees;
use Thirty98\API\Calculator\Utils\Contracts\StateFees\OtherFeeServiceInterface;
use Thirty98\API\Calculator\Utils\Services\StateFees\AbstractOtherFeesService;

class OtherFeesService extends AbstractOtherFeesService implements OtherFeeServiceInterface
{
    protected $state = 'LA';

    public function __construct($vehicle_type, $type_of_plate, $vehicle_service)
    {
        parent::__construct($vehicle_type, $type_of_plate, $vehicle_service);
    }

    public function getOtherFees()
    {
        $other_fees = parent::getOtherFees();
        $other_fees['handling_fee'] = $this->getHandlingFee();
        $other_fees['notary_fee'] = $this->getNotaryFee();

        return $other_fees;
    }

    public function getMiscellaneousFee()
    {
        return 0;
    }

    public function getHandlingFee()
    {
        return $this->vehicle_service->getVehicleFeeByState($this->state, $this->vehicle_type, 'handling_fee');
    }

    public function getNotaryFee()
    {
        if ($this->type_of_plate == "TRC") {
            return 0;
        }

        return $this->vehicle_service->getVehicleFeeByState($this->state, $this->vehicle_type, 'notary_fee');
    }


}
