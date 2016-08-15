<?php

namespace Thirty98\API\General\Entities;

class ApiException extends \Exception
{
    private $data;
    private $responseCode;

    public function __construct($responseCode = '', $message = '', $data = '', $code = 0, \Exception $previous = null)
    {
        $this->responseCode = $responseCode;
        $this->data = $data;

        parent::__construct($message, $code, $previous);
    }

    /**
     * Get the error data.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get the error response code.
     * See: \App\Http\Entities\ApiResponse for the CONST response codes.
     *
     * @return string
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }
}

#END OF PHP FILE