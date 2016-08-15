<?php

namespace Thirty98\API\TaxWatch\Models;

use GuzzleHttp\Client;

class TaxWatch
{

    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getTaxWatchFees($taxable_value, $state, $street_address, $zip, $county, $city)
    {
        $config = [];

        $params = "address='" . $street_address . "'&state=" . $state . "'&zip=" . $zip . "'&city=" . $city . "'&county=" . $county . "'&amount=" . $taxable_value;
        $url = 'http://taxwatch.mesasixdev.com/api?' . $params;

        return $this->connect($url, $config);
    }

    protected function connect($url, Array $config)
    {
        try {
            $result = $this->client->get($url, $config);
            return json_decode($result->getBody()->getContents(), true);
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}

