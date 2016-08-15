<?php

namespace Thirty98\API\General\Contracts;

use Illuminate\Http\Request;

interface CalculatorInputInterface
{

    /**
     * Get type.
     *
     * @return mixed
     */
    public function getType();

    /**
     * Get category.
     *
     * @return mixed
     */
    public function getCategory();

    /**
     * Get HTTP request.
     *
     * @return Request
     */
    public function getRequest();
}
#END OF PHP FILE