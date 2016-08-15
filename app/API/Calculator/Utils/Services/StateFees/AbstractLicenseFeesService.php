<?php

namespace Thirty98\API\Calculator\Utils\Services\StateFees;

use Thirty98\API\Calculator\Services\VehicleFeesService;

abstract class AbstractLicenseFeesService
{
    protected $details = [];
    protected $model;

    public function __construct($details, $model)
    {
        $this->details = $details;
        $this->model = $model;
    }

    public function getLicenseFees()
    {
        return [
            'license_fee' => $this->getLicenseFee()
        ];
    }

    abstract protected function getLicenseFee();
}
