<?php

namespace Thirty98\FeeCalculator\Controller;

use Thirty98\FeeCalculator\Http\Controllers\Controller;

abstract class AbstractFeeController extends Controller 
    implements FeeAwareInterface
{
    
    protected $model;
    
    public function __construct(StateModel $model)
    {
        $this->model = $model;
    }
    
    public function getDocumentFee()
    {
        return $this->model->document_fee;
    }
}

