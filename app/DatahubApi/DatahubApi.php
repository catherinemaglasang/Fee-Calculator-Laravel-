<?php

namespace Thirty98\DatahubApi;

use GuzzleHttp\Client;
use ApiResponse;

/**
 * Actual API connection to DataHUb API serviec
 */
class DatahubApi
{
    protected $client;
    protected $debug = false;
    protected $httpErrors = false;

    function __construct(Client $client)
    {
        $this->client = new Client();
    }

    /**
     * @param  string
     * @param  string
     * @param  mixed
     * @return mixed
     */
    public function connect($path, $method, $options = [])
    {
        switch ($method) {
            case "GET": {
                try {
                    return json_decode($this->client->get($path, $options)->getBody()->getContents(), true);
                }  catch (\Exception $error) {
                    // return $error->getMessage();
                    return [];
                }

                break;
            }
            case "POST": {
                try {
                    return json_decode($this->client->post($path, [
                        'body' => $options
                    ])->getBody()->getContents(), true);
                }  catch (\Exception $error) {
                    // return $error->getMessage();
                    return [];
                }
                break;
            }
        }

        /*try {
            $response = $this->client->request($method, $path, $options);
            $body = json_decode( $response->getBody() );

            if ( $body->response_code )
                return $body;

            return false;
        } catch (Guzzle\Http\Exception\ClientException $e) {
            return $this->debug ? $e->getMessage(): false;
        }*/
    }

    /**
     * @param  string
     * @param  array
     * @return mixed
     */
    public function get($path, $params = [])
    {
        return $this->connect($path, 'GET', ['query' => $params]);
    }

    /**
     * @param  string
     * @param  array
     * @return mixed
     */
    public function post($path, $data = [], $query = [])
    {
        return $this->connect($path, 'POST', ['json' => $data, 'query' => $query]);
    }

    /**
     * @param  string
     * @param  array
     * @return mixed
     */
    public function put($path, $data = [], $query = [])
    {
        return $this->connect($path, 'PUT', ['json' => $data, 'query' => $query]);
    }

    /**
     * @param  string
     * @param  array
     * @return mixed
     */
    public function delete($path, $data = [])
    {
        return $this->connect($path, 'DELETE', ['json' => $data]);
    }
}

// EOF