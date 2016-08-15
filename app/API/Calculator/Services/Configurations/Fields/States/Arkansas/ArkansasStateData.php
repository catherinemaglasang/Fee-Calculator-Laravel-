<?php

namespace Thirty98\API\Calculator\Services\Configurations\Fields\States\Arkansas;

use Thirty98\API\Stdlib\Helpers\RequestHelperService;


class ArkansasStateData
{
    protected $master_fields = [];

    public function filter($master_fields, $payload)
    {
        $this->master_fields = $master_fields;

        return $this->master_fields;
    }
}