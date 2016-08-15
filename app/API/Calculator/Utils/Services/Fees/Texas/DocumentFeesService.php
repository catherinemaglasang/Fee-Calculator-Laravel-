<?php

namespace Thirty98\API\Calculator\Utils\Services\Fees\Texas;

use Thirty98\API\Calculator\Utils\Services\Fees\AbstractDocumentFeeService;
use Datahub;
use Auth;

class DocumentFeesService extends AbstractDocumentFeeService
{
    protected $state;
    
    public final function getRate()
    {
        // return 125.00;
        $baseUrl = env('ADMIN_API_URL');
        $response = Datahub::get($baseUrl . 'application/fees', ['user_id' => Auth::id(), 'fee' => 'document_fee']);

        if($response->data->data){
        	$fee = (float)$response->data->data;
        }else{
        	$fee = 0;
        }
        
        return $fee;
    }
}

