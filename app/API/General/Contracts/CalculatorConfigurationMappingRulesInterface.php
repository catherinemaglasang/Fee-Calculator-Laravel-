<?php

namespace Thirty98\API\General\Contracts;

interface CalculatorConfigurationMappingRulesInterface
{
    /**
     * Different mapping functions required for the configuration service.
     */

    public function getMappingRuleByState($fields);
    public function getMappingRuleByTransactionType($fields, $payload);
    public function getMappingRuleByVehicleType($fields, $payload);
    public function getMappingRuleByCheckbox($fields, $payload);
}
#END OF PHP FILE