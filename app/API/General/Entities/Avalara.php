<?php

namespace Thirty98\API\General\Entities;

use DB;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Avalara
{
    private $locationRepository;
    private $client;

    public function __construct()
    {
        $this->locationRepository = new LocationRepository;
        $this->client = new Client;
    }

    /**
     * Get sales tax rate.
     *
     * @param string $address
     * @param int $amount
     * @return array|mixed|ApiException
     */
    public function salesTaxRate($address = '', $amount = 0)
    {
        $location = $this->locationRepository->getLatLngByAddress($address);

        if ($location instanceof ApiException) {
            return $location;
        }

        try {
            $url = env('AVALARA_API_URL') . '/' . $location['lat'] . ',' . $location['lng'] . '/get';

            $response = $this->client->get(
                $url,
                ['auth' => [env('AVALARA_USERNAME'), env('AVALARA_PASSWORD')],
                    'query' => ['saleamount' => $amount]]
            );

            return json_decode($response->getBody(), true);
        } catch (ClientException $e) {
            return new ApiException(
                ApiResponse::CODE_BAD_REQUEST,
                'Unable to connect to Avalara.',
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

    public function getSalesTaxPenalty($salesTax, $dateOfSale)
    {
        // Formula: currentdate - end date
        // Get difference.
        // If above 40 start multiplying every 30 days
        if (strtotime($dateOfSale) == "") {
            return "";
        }

        $dateDifference = (strtotime(date('Y-m-d')) - strtotime($dateOfSale)) / (60 * 60 * 24);

        if ($dateDifference >= 40) {
            if ($dateDifference > 150) {
                $dateDifference = 150;
            }

            $penaltyMultiplier = (int)($dateDifference / 30);
            $salesTaxPenalty = $salesTax * (0.05 * $penaltyMultiplier);

            return $salesTaxPenalty;
        } else {
            return "";
        }
    }

    public function getInterest($salesTax, $dateOfSale)
    {
        $dateDifference = (strtotime(date('Y-m-d')) - strtotime($dateOfSale)) / (60 * 60 * 24);

        if ($dateDifference > 0) {
            $interest = $salesTax * (0.0125 * $dateDifference);

            return $interest;
        } else {
            return "";
        }
    }

    public function getVendorsComp($salesTax, $state, $parish, $city)
    {
        // Query state.
        $sql_vendor_comp = "
                    SELECT
                      p.area_vendor_desc,
                      p.parish_vendor_desc
                    FROM
                      parish_city_details p
                      INNER JOIN cities ct
                        ON ct.id = p.`city_id`
                        AND ct.`name` = :city_name
                      INNER JOIN counties c
                        ON ct.`county_id` = c.id
                        AND c.`state_id` =
                        (SELECT
                          id
                        FROM
                          states
                        WHERE `code` = :state_name)
                        AND c.`is_parish` = 1
                        AND c.`name` = :parish_name
        ";

        $exists = DB::select(DB::raw($sql_vendor_comp), array(
            'city_name' => $city,
            'state_name' => $state,
            'parish_name' => $parish
        ));

        if ($exists) {
            $result = $salesTax * ($exists[0]->area_vendor_desc + $exists[0]->parish_vendor_desc);
        } else {
            $result = "";
        }

        return $result;
    }

    public function louisianaSalesTaxRate($address = '', $amount = 0, $dateOfSale, $parish, $city, $sales_tax_credit)
    {
        $location = $this->locationRepository->getLatLngByAddress($address);

        if ($location instanceof ApiException) {
            return $location;
        }

        try {
            $url = env('AVALARA_API_URL') . '/' . $location['lat'] . ',' . $location['lng'] . '/get';

            $response = $this->client->get(
                $url,
                ['auth' => [env('AVALARA_USERNAME'), env('AVALARA_PASSWORD')],
                    'query' => ['saleamount' => $amount]]
            );

            $result = json_decode($response->getBody(), true);

            if ($dateOfSale != false) {
                // Isolate tax.
                $salesTax = $result['Tax'];
                $salesTaxPenalty = $this->getSalesTaxPenalty($salesTax, $dateOfSale);

                $result['Sales Tax Penalty'] = $salesTaxPenalty;
                $result['Interest'] = $this->getInterest($salesTax, $dateOfSale);

                if (isset($result['TaxDetails'][0]['Region']) && $parish != false) {
                    $state = $result['TaxDetails'][0]['Region'];
                    $result['Vendors Comp'] = $this->getVendorsComp($salesTax, $state, $parish, $city);
                } else {
                    $result['Vendors Comp'] = "";
                }

                if ($sales_tax_credit) {
                    $result['Sales Tax Credit'] = $sales_tax_credit;
                } else {
                    $result['Sales Tax Credit'] = "";
                }
            }

            $tax_details = $result['TaxDetails'];


            foreach ($tax_details as $key => $value) {
                $jurisName = $value['JurisName'];

                // Try to get city, else parish only.
                $city_tax = $this->getCityFee($salesTax, $jurisName);

                if ($city_tax) {
                    $tax_details[$key]['County / City Tax'] = $city_tax;
                } else {
                    // Get city
                    $parish_tax = $this->getParishFee($salesTax, $jurisName);

                    if ($parish_tax) {
                        $tax_details[$key]['County / City Tax'] = $parish_tax;
                    } else {
                        $tax_details[$key]['County / City Tax'] = 0;
                    }
                }
            }

            $result['TaxDetails'] = $tax_details;

            return $result;

        } catch (ClientException $e) {
            return new ApiException(
                ApiResponse::CODE_BAD_REQUEST,
                'Unable to connect to Avalara.',
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

    public function getParishFee($tax, $parish)
    {
        $sql = "
            SELECT
              p.parish_tax,
              p.parish_vendor_desc
            FROM
              parish_city_details p
              INNER JOIN cities c
                ON c.id = p.`city_id`
                AND LOWER(c.name) = LOWER('Parish Only')
              INNER JOIN counties cn
                ON cn.`id` = c.`county_id`
                AND LOWER(cn.`name`) = LOWER(:parish_name)
              INNER JOIN states s
                ON s.id = cn.`state_id`
        ";

        $exists = DB::select(DB::raw($sql), array(
            'parish_name' => $parish
        ));

        if ($exists) {
            $parish_tax = $exists[0]->parish_tax;
            $parish_vendor_desc = $exists[0]->parish_vendor_desc;

            $tax = $tax * ($parish_tax * $parish_vendor_desc);

            return $tax;
        } else {
            return false;
        }
    }

    public function getCityFee($tax, $city)
    {
        $sql = "
            SELECT
              p.parish_tax,
              p.parish_vendor_desc
            FROM
              parish_city_details p
              INNER JOIN cities c
                ON c.id = p.`city_id` AND
                LOWER(c.`name`) = LOWER(:city_name)
              INNER JOIN counties cn
                ON cn.`id` = c.`county_id`
              INNER JOIN states s
                ON s.id = cn.`state_id`
        ";

        $exists = DB::select(DB::raw($sql), array(
            'city_name' => $city
        ));

        if ($exists) {
            $parish_tax = $exists[0]->parish_tax;
            $parish_vendor_desc = $exists[0]->parish_vendor_desc;

            $tax = $tax * ($parish_tax * $parish_vendor_desc);

            return $tax;
        } else {
            return false;
        }
    }


    public function verifyLocation($street_address, $zip_code)
    {
        $arr = [
            'Street Address' => $street_address,
            'Zip Code' => $zip_code
        ];

        try {
            $url = 'https://avatax.avalara.net/1.0/address/validate?' . 'Line1=' . $street_address . '&PostalCode=' . $zip_code;

            $result = $this->client->get($url, [
                'auth' => [env('AVALARA_USERNAME'), env('AVALARA_PASSWORD')]
            ]);

            return $result->getBody();
        } catch (ClientException $e) {
            return new ApiException(
                ApiResponse::CODE_BAD_REQUEST,
                'Unable to connect to Avalara.',
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

    public function salesTaxRate2($address = '', $amount = 0)
    {
        $info = array(
            'avalara API' => env('AVALARA_API_URL'),
            'username' => env('AVALARA_USERNAME'),
            'password' => env('AVALARA_PASSWORD')
        );

        return $info;
        $location = $this->locationRepository->getLatLngByAddress($address);

        if ($location instanceof ApiException) {
            return $location;
        }

        try {
            $url = env('AVALARA_API_URL') . '/' . $location['lat'] . ',' . $location['lng'] . '/get';
            $response = $this->client->get(
                $url,
                ['auth' => [env('AVALARA_USERNAME'), env('AVALARA_PASSWORD')],
                    'query' => ['saleamount' => $amount]]
            );

            return json_decode($response->getBody(), true);

            //return ['tax' => $result['Tax'], 'rate' => $result['Rate']];

        } catch (ClientException $e) {
            return new ApiException(
                ApiResponse::CODE_BAD_REQUEST,
                'Unable to connect to Avalara.',
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