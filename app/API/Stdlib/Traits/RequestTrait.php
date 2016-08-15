<?php

namespace Thirty98\API\Stdlib\Traits;

use GuzzleHttp\Client;

trait RequestTrait
{
    public function ifParam($arr, $index)
    {
        if (isset($arr[$index])) {
            if ($arr[$index] == true) {
                return true;
            }
        }

        return false;
    }

    public function getPostRequest($url, $body)
    {
        // use GuzzleHttp\Client;
        // $this->client = new Client()
        // $result = $this->client->get($url, $config);
        $guzzle = new Client();

        try {
            $request = $guzzle->post(
                url() . $url,
                array(
                    'body' => $body
                )
            );

            return json_decode($request->getBody()->getContents());
        } catch (\Exception $error) {
            return $error->getMessage();
        }
    }
}