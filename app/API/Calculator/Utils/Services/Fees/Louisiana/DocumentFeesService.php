<?php

namespace Thirty98\API\Calculator\Utils\Services\Fees\Louisiana;

use Thirty98\API\Calculator\Utils\Services\Fees\AbstractDocumentFeeService;
use Datahub;
use Auth;

class DocumentFeesService extends AbstractDocumentFeeService
{
    public final function getRate()
    {
        return 200.00;

        $baseUrl = env('ADMIN_API_URL');
        $response = Datahub::get($baseUrl . 'application/fees', ['user_id' => Auth::id(), 'fee' => 'document_fee']);

        dd($response);

        if($response->data->data){
        	$fee = (float)$response->data->data;
        }else{
        	$fee = 0;
        }
        
        return $fee;
    }
}
