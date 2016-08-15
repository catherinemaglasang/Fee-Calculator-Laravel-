<?php

namespace Thirty98\DatahubApi;

use GuzzleHttp\Client;
use Thirty98\DatahubApi\DatahubApi;
use Illuminate\Support\ServiceProvider;

class DatahubApiServiceProvider extends ServiceProvider {
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('datahubApi', function()
        {
            $client = new Client([
                'base_uri' => env('DATAHUB_API_URL')
            ]);

            return new DatahubApi($client);
        });
    }
}

// EOF