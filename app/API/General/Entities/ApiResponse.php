<?php

namespace Thirty98\API\General\Entities;

use Illuminate\Support\Facades\Request;

class ApiResponse
{
    const CODE_SUCCESS = 'SUCCESS';
    const CODE_BAD_REQUEST = 'BAD_REQUEST';
    const CODE_NOT_FOUND = 'NOT_FOUND';
    const CODE_UNAUTHORIZED = 'UNAUTHORIZED';
    const CODE_INTERNAL_SERVER_ERROR = 'INTERNAL_SERVER_ERROR';
    const CODE_FORBIDDEN = 'FORBIDDEN';

    const HTTPCODE_SUCCESS = 200;
    const HTTPCODE_NOT_FOUND = 404;
    const HTTPCODE_BAD_REQUEST = 400;
    const HTTPCODE_UNAUTHORIZED = 401;
    const HTTPCODE_INTERNAL_SERVER_ERROR = 500;
    const HTTPCODE_FORBIDDEN = 403;

    /**
     * Generate a Success API response.
     *
     * @param string $responseMsg
     * @param $data
     * @param int $httpCode
     * @param array $headers
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public static function success($responseMsg = '', $data, $httpCode = 200, $headers = [])
    {
        $response = self::prepareResponse($httpCode, ApiResponse::CODE_SUCCESS, $responseMsg, $data);

        // Override HTTP code, if suppressed.
        if (self::isSuppressResponseCodes()) {
            $httpCode = ApiResponse::HTTPCODE_SUCCESS;
        }

        return response($response, $httpCode, $headers);
    }

    /**
     * Prepare API response.
     *
     * @param $httpCode
     * @param $responseCode
     * @param $responseMsg
     * @param $data
     * @return array
     */
    public static function prepareResponse($httpCode, $responseCode, $responseMsg, $data)
    {
        return [
            'http_code' => $httpCode,
            'response_code' => $responseCode,
            'response_msg' => $responseMsg,
            'data' => $data
        ];
    }

    /**
     * Check if request want to suppress response codes.
     *
     * @return bool
     */
    public static function isSuppressResponseCodes()
    {
        if (Request::input('suppress_response_codes') === 'true') {
            return true;
        }

        return false;
    }

    /**
     * Generate a Failed API response.
     *
     * @param string $responseCode
     * @param string $responseMsg
     * @param array $data
     * @param int $httpCode
     * @param array $headers
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public static function error($responseCode = '', $responseMsg = '', $data = [], $httpCode = 400, $headers = [])
    {
        $responseCode = !$responseCode ? ApiResponse::CODE_BAD_REQUEST : $responseCode;

        $response = self::prepareResponse($httpCode, $responseCode, $responseMsg, $data);

        // Override HTTP code, if suppressed.
        if (self::isSuppressResponseCodes()) {
            $httpCode = ApiResponse::HTTPCODE_SUCCESS;
        }

        return response($response, $httpCode, $headers);
    }
}

#END OF PHP FILE