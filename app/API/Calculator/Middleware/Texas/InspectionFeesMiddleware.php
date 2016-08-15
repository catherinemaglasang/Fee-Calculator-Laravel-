<?php

namespace Thirty98\API\Calculator\Middleware\Texas;

use Thirty98\API\Stdlib\Middleware\AbstractPostMiddleware;
use Thirty98\API\Calculator\Services\SalesTaxRateFactoryService;

class InspectionFeesMiddleware extends AbstractPostMiddleware
{

    protected $factory;

    public function __construct(SalesTaxRateFactoryService $factory)
    {
        $this->factory = $factory;
    }

    protected function updateRequest(Array $payload)
    {
        return $payload;
    }

    protected function postValidationRules()
    {
        return [
            'code' => 'required'
        ];
    }
}
