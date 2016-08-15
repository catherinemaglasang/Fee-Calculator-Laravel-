<?php

namespace Thirty98\API\General\Entities;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Symfony\Component\HttpFoundation\ParameterBag;
use Thirty98\API\Extras\FI\Entities\ResponseTransformer;
use Thirty98\API\General\Models\TtlType;

class TtlTypeRepository
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Calculate Fees.
     *
     * @param $stateCode
     * @param ParameterBag $request
     * @return array|ApiException
     */
    public function calculate($stateCode, ParameterBag $request)
    {
        try {
            $dataOne = $this->getDataOneByVin($request->get('vin'));
            // Reset request inputs.
            $request->set('model_year', $dataOne->year);
            $request->set('fuel_type', $dataOne->fuel_type);
            $request->set('vin_pattern', $dataOne->vin_pattern);

            // Get GVW.
            $request->set('gvw', $this->getGVW($dataOne->id));

            $request->set('seat_no', mt_rand(1, 5)); // TODO: Where the heck?
            $request->set('freight', mt_rand(20, 25)); // TODO: Where the heck?

            $url = url('api/v1/calculate/' . $stateCode . '?api_key=' . env('API_KEY'));

            $response = $this->client->post($url, [
                'body' => json_encode($request->all()),
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]);

            $data = json_decode($response->getBody());
            if ($response->getStatusCode() !== 200) {
                throw new ApiException($data->response_code, $data->response_msg, $data->data, $response->getStatusCode());
            }

            // Transform response data.
            $transformer = new ResponseTransformer($data->data, $request->get('ttl_type'), $stateCode);

            return $transformer->transform();

        } catch (ClientException $e) {
            $responseBody = json_decode($e->getResponse()->getBody());
            return new ApiException(ApiResponse::CODE_BAD_REQUEST, $responseBody->response_msg, null, ApiResponse::HTTPCODE_BAD_REQUEST);
        } catch (\Exception $e) {
            return new ApiException(ApiResponse::CODE_BAD_REQUEST, $e->getMessage(), null, ApiResponse::HTTPCODE_BAD_REQUEST);
        }
    }

    /**
     * Get list of TTL Types.
     *
     * @return mixed
     */
    public function ttlTypes()
    {
        $ttlTypes = TtlType::orderBy('code', 'asc')->get();

        return $ttlTypes->toArray();
    }

    /**
     * Get Dataone record by vin pattern.
     *
     * @param string $vin
     * @return mixed
     * @throws ApiException
     */
    private function getDataOneByVin($vin = '')
    {

        try {
            $url = url('api/v1/vinpatterns/' . $vin . '?api_key=' . env('API_KEY'));

            $response = $this->client->get($url, [
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]);

            $data = json_decode($response->getBody());
            if ($response->getStatusCode() !== 200) {
                throw new ApiException($data->response_code, $data->response_msg, $data->data, $response->getStatusCode());
            }

            return $data->data[0];

        } catch (ClientException $e) {
            $responseBody = json_decode($e->getResponse()->getBody());
            return new ApiException(ApiResponse::CODE_BAD_REQUEST, $responseBody->response_msg, null, ApiResponse::HTTPCODE_BAD_REQUEST);
        } catch (\Exception $e) {
            return new ApiException(ApiResponse::CODE_BAD_REQUEST, $e->getMessage(), null, ApiResponse::HTTPCODE_BAD_REQUEST);
        }
    }

    /**
     * Get GVW by vehicle id.
     *
     * @param int $vehicleId
     * @return int|ApiException
     */
    private function getGVW($vehicleId = 0)
    {
        try {
            $url = url('api/v1/grossvehicleweight/' . $vehicleId . '?api_key=' . env('API_KEY'));

            $response = $this->client->get($url, [
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]);

            $data = json_decode($response->getBody());
            if ($response->getStatusCode() !== 200) {
                throw new ApiException($data->response_code, $data->response_msg, $data->data, $response->getStatusCode());
            }

            return intval($data->data->gvw);

        } catch (ClientException $e) {
            $responseBody = json_decode($e->getResponse()->getBody());
            return new ApiException(ApiResponse::CODE_BAD_REQUEST, $responseBody->response_msg, null, ApiResponse::HTTPCODE_BAD_REQUEST);
        } catch (\Exception $e) {
            return new ApiException(ApiResponse::CODE_BAD_REQUEST, $e->getMessage(), null, ApiResponse::HTTPCODE_BAD_REQUEST);
        }
    }
}

#END OF PHP FILE