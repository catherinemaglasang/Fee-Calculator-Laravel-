<?php

namespace Thirty98\API\General\Controllers;

use Illuminate\Http\Request;
use Thirty98\API\General\Contracts\CalculationLoaderInterface;
use Thirty98\API\General\Entities\ApiException;
use Thirty98\API\General\Entities\ApiResponse;
use Thirty98\API\General\Entities\CalculatorResponse;
use Thirty98\Http\Controllers\Controller;

class CalculatorController extends Controller
{
    /**
     * Calculate.
     *
     * @param Request $request
     * @return array
     */
    public function postCalculate($stateCode, Request $request)
    {
        try {
            // Namespace
            $namespace = $this->getNamespaceByStateCode($stateCode);

            // Prepare input data.
            $calculatorInput = $namespace . '\\' . 'Entities\CalculatorInput';
            $input = new $calculatorInput($request);

            // Load appropriate Calculator
            $calculatorLoader = $namespace . '\\' . 'Entities\CalculatorLoader';
            $calculator = new $calculatorLoader($input);

            if (!$calculator instanceof CalculationLoaderInterface) {
                throw new ApiException(
                    ApiResponse::CODE_BAD_REQUEST,
                    '$calculator is not an instance of CalculationLoaderInterface.',
                    null,
                    ApiResponse::HTTPCODE_BAD_REQUEST
                );
            }

            $calculator = $calculator->get();

            $response = $calculator->calculate();

            $result = $response;
            if ($response instanceof CalculatorResponse) {
                $result = $response->toArray();
            }

            return ApiResponse::success('Here are your data.', $result);

        } catch (ApiException $e) {
            // Show error response.
            return ApiResponse::error($e->getResponseCode(), $e->getMessage(), $e->getData(), $e->getCode());
        }
    }

    /**
     * Get namespace based on state code.
     *
     * @param string $stateCode
     * @return string
     * @throws ApiException
     */
    private function getNamespaceByStateCode($stateCode = '')
    {
        switch ($stateCode) {
            case 'TX':
                return '\Thirty98\API\Texas';
                break;
            case 'DE':
                return '\Thirty98\API\Delaware';
                break;
            case 'LA':
                return '\Thirty98\API\Louisiana';
                break;
            default:
                throw new ApiException(
                    ApiResponse::CODE_BAD_REQUEST,
                    'State Code: ' . $stateCode . ' is not yet supported.',
                    null,
                    ApiResponse::HTTPCODE_BAD_REQUEST
                );
        }
    }
}

#END OF PHP FILE