<?php

namespace Thirty98\Http\Controllers;

use Auth;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Thirty98\Http\Controllers\Models\Vin;
use Thirty98\Http\Controllers\Models\Categories;
use Thirty98\Http\Controllers\Models\CategoriesTypes;
use Thirty98\Http\Controllers\Models\Types;

class CalculatorCheckpointController extends Controller
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getTypeAndCatByVin($vin)
    {
        return $this->getVinPatternRecordByVin($vin);
    }

    public function getVinByTypeAndCat($data)
    {
        return $this->getVinPatternRecordByCat($data);
    }

    /**
     * Get List of VIN Patterns.
     *
     * @param $vin
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    private function getVinPatternRecordByVin($vin)
    {
        $response = $this->client->get(url('api/v1/vinpatterns/' . $vin . '?api_key=' . env('API_KEY')));

        return response($response->getBody(), $response->getStatusCode(), ['Content-Type' => 'application/json']);
    }

    /**
     * Get VIN pattern.
     *
     * @param $category , $type
     * @return mixed
     *
     */

    private function getVinPatternRecordByCat($params)
    {
        $params = explode('&', $params);

        $data = [
            'success' => false,
            'data' => null
        ];

        $vinPattern = DB::connection('mysql_mytrs')
            ->table('DataOneVINPatterns')
            ->where('vehicle_type', $params[0])
            ->where('body_type', $params[1])->get();

        if ($vinPattern) {
            $data['success'] = true;
            $data['data'] = $vinPattern;
        }

        return $data;
    }

    /**
     * Calculate Fees.
     *
     * @param $stateCode
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function calculate($stateCode, Request $request)
    {
        $response = $this->client->post(url('api/v1/calculate/' . $stateCode . '?api_key=' . env('API_KEY')), [
            'body' => json_encode($request->all()),
            'headers' => ['Content-Type' => 'application/json']
        ]);

        return response($response->getBody(), $response->getStatusCode(), $response->getHeader('Content-Type'));
    }

    /**
     * Get Category types.
     *
     * @param $stateCode
     * 
     */
    public function getCategoriesTypes()
    {   
        $data = [];
        $Categories = Categories::all();
        $types = Types::all();
        $CategoriesTypes = CategoriesTypes::all();
        foreach ($CategoriesTypes as $a => $value_one) {
            $type_id = $value_one->type_id;
            $type_category_id = $value_one->category_id;
            foreach ($types as $b => $value_two) {
                if($value_two->id == $type_id){
                    $type_name = $value_two->name;
                    $category_slug = $value_two->slug;
                    foreach ($Categories as $c => $value_three) {
                        $category_name = $value_three->name;
                        if($value_three->id == $type_category_id){
                            if($category_slug){
                                array_push($data,['name' => $category_slug, 'category' => $category_name, 'type' => $type_name]);
                            }
                            break;
                        }
                    }
                    break;
                }
            }
        }
        return $data;
    }
}
