<?php

namespace Thirty98\API\Avalara\Models;

use GuzzleHttp\Client;

class Avalara
{
    private $username;
    private $password;
    protected $client;

    public function __construct()
    {
        $this->username = env('AVALARA_USERNAME');
        $this->password = env('AVALARA_PASSWORD');
        $this->client = new Client();
    }

    public function verifyLocation($street_address, $zipcode)
    {
        $config = [
            'auth' => [$this->username, $this->password]
        ];
        
        $params = "Line1='" . $street_address . "'&PostalCode=" . $zipcode;
        $url = 'https://avatax.avalara.net/1.0/address/validate?' . $params;
        
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

