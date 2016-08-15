<?php

namespace Thirty98\API\General\Services;

use GuzzleHttp\Client;

class FeeCalculatorService
{
    protected $client;
    
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    
    public function calculate($payload)
    {
        $namespace = $this->getNamespaceByStateCode($payload->state);
        
        if (isset($namespace['error'])) {
            return $namespace;
        }
        
        // Prepare input data.
        $calculatorInput = $namespace . '\\' . 'Entities\CalculatorInput';
        $input = new $calculatorInput($payload);
        
        // Load appropriate Calculator
        $calculatorLoader = $namespace . '\\' . 'Entities\CalculatorLoader';
        $calculator = new $calculatorLoader($input);
        
        try {
            $result = $calculator->get();
            return $result->calculate()->toArray();
        } catch (\Exception $error) {
            return ['error' => $error->getMessage()];
        }
    }
    
    
    private function getNamespaceByStateCode($code)
    {
        switch (strtoupper($code)) {
            case 'TX':  return '\Thirty98\API\Texas';
            case 'LA':  return '\Thirty98\API\Louisiana';
            default: return ['error' => "State Code: {$code} is not yet supported."];
        }
    }
}