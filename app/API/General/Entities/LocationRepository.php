<?php

namespace Thirty98\API\General\Entities;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class LocationRepository
{
    /**
     * Get latitude and longitude values of an address.
     *
     * @param string $address
     * @return array|ApiException
     * @throws ApiException
     */
    public function getLatLngByAddress($address = '')
    {
        if (!$address) {
            return new ApiException(
                ApiResponse::CODE_BAD_REQUEST,
                'Invalid address.',
                null,
                ApiResponse::HTTPCODE_BAD_REQUEST
            );
        }

        $client = new Client;

        try {
            $response = $client->get(
                'https://maps.googleapis.com/maps/api/geocode/json',
                ['query' => ['address' => $address]]
            );

            $result = json_decode($response->getBody());

            // If failed to get lat and lng for an address.
            if (is_null($result) OR (isset($result->status) AND $result->status !== 'OK')) {
                throw new ApiException(
                    ApiResponse::CODE_BAD_REQUEST,
                    'Unable to parse location.',
                    null,
                    ApiResponse::HTTPCODE_BAD_REQUEST
                );
            }

            return [
                'lat' => $result->results[0]->geometry->location->lat,
                'lng' => $result->results[0]->geometry->location->lng
            ];

        } catch (ClientException $e) {
            return new ApiException(
                ApiResponse::CODE_BAD_REQUEST,
                'Unable to connect to location API. Code: ' . $e->getResponse()->getStatusCode(),
                null,
                ApiResponse::HTTPCODE_BAD_REQUEST
            );
        } catch (\Exception $e) {
            return new ApiException(
                ApiResponse::CODE_BAD_REQUEST,
                $e->getMessage(),
                null,
                ApiResponse::HTTPCODE_BAD_REQUEST
            );
        }
    }
}
#END OF PHP FILE