<?php

namespace Thirty98\API\Calculator\Controllers;

use Thirty98\API\Stdlib\Controllers\AbstractPostController;
use Thirty98\API\Calculator\Services\CalculatorConfigurationFactoryService;
use Thirty98\API\Calculator\Services\CalculatorConfigurationFactoryServiceNew;
use Thirty98\API\Stdlib\Services\ResponseService;
use Illuminate\Http\Request;

class CalculatorConfigurationController extends AbstractPostController
{
    /**
     * Single Responsiblity: A class should only do one thing, in this case merely a collector of other classes.
     */

    protected $factory;
    protected $factory_new;
    protected $payload;

    public function __construct(CalculatorConfigurationFactoryService $factory, CalculatorConfigurationFactoryServiceNew $factory_new)
    {
        $this->factory = $factory;
        $this->factory_new = $factory_new;
    }

    public function configure2(Request $request)
    {
        $payload = $request->all();

        $result = $this->factory_new->configure2($payload);

        $response = ['configuration' => $result, 'payload' => $payload];
        return ResponseService::success("Here's the configuration", $response);

        return $result;
    }

    public function feeConfiguration(Request $request)
    {
        $payload = $request->all();

        $result = $this->factory_new->configure2($payload);

        $response = ['configuration' => $result, 'payload' => $payload];
        return ResponseService::success("Here's the configuration", $response);

        return $result;
    }


    public function configure(Request $request)
    {
        $payload = $request->all();

        $validator = $this->postRequestValidator($payload);
        if ($validator->fails()) {
            $response = ['errors' => $validator->errors(), 'payload' => $payload];
            return ResponseService::success("Validation failed", $response, 200, "FAILED_VALIDATION");
        }

        $output = $this->factory->configure($payload);
        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }

        $response = ['configuration' => $output, 'payload' => $payload];
        return ResponseService::success("Here's the configuration", $response);
    }

    protected function postValidationRules()
    {
        return [
            'transaction_type' => 'sometimes|string'
        ];
    }
}