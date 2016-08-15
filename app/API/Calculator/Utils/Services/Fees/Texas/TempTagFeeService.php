<?php

namespace Thirty98\API\Calculator\Utils\Services\Fees\Texas;

use Datahub;
use Auth;

class TempTagFeeService
{
    public final function getRate()
    {
        // return 5.00;

        $baseUrl = env('ADMIN_API_URL');
        $response = Datahub::get($baseUrl . 'application/fees', ['user_id' => Auth::id(), 'fee' => 'temp_tag_fee']);

        if($response->data->data){
        	$fee = (float)$response->data->data;
        }else{
        	$fee = 0.00;
        }
        
        return $fee;
    }
}

