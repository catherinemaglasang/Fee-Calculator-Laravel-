<?php

namespace Thirty98\API\Texas\Entities;

use Illuminate\Http\Request;
use Thirty98\API\General\Contracts\CalculatorInputInterface;
use Thirty98\API\General\Contracts\InputInterface;

class CalculatorInput implements CalculatorInputInterface
{
    private $request;
    private $type;
    private $category;

    public function __construct(Request $request)
    {
        // Get raw request.
        $this->request = $request;

        // Prepares data.
        $this->type = $this->request->get('type');
        $this->category = $this->request->get('category');
    }

    /**
     * Get type.
     *
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get category.
     *
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Get HTTP request.
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }
}

#END OF PHP FILE