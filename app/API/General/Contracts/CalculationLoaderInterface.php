<?php

namespace Thirty98\API\General\Contracts;

interface CalculationLoaderInterface
{
    /**
     * Get list of category-type mapping or relationship.
     *
     * @return array
     */
    public function getMappings();

    /**
     * Get calculation type.
     *
     * @return mixed
     */
    public function get();
}
#END OF PHP FILE