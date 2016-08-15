<?php

namespace Thirty98\API\POS\Middleware;

use Thirty98\API\Stdlib\Middleware\AbstractPostMiddleware;

class POSCodesMiddleware extends AbstractPostMiddleware
{
    protected $pos_service;
    protected $vehicle_service;


    public function __construct()
    {

    }

    protected function updateRequest(Array $payload)
    {
        if (!in_array($this->payload['title_code'], $this->getTitleCodes())) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "Title Code not found.",
                    'response_code' => "DATA_NOT_FOUND",
                    "exception" => "No title code: '{$this->payload['title_code']}' found."
                ]
            ];
        }

        if (!in_array($this->payload['license_code'], $this->getLicenseCodes())) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "License Code not found.",
                    'response_code' => "DATA_NOT_FOUND",
                    "exception" => "No license code: '{$this->payload['license_code']}' found."
                ]
            ];
        }

        return $payload;
    }

    protected function postValidationRules()
    {
        return [
            "title_code" => "required|string",
            "license_code" => "required|string"
        ];
    }

    public function getLicenseCodes()
    {
        return [
            "C",
            "N",
            "E",
            "R",
            "F",
            "T",
            "L",
            "U"
        ];
    }

    public function getTitleCodes()
    {
        return [
            "Y",
            "N",
            "F",
            "L",
            "E",
        ];
    }
}
