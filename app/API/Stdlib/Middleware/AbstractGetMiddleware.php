<?php

namespace Thirty98\API\Stdlib\Middleware;

use Thirty98\API\Stdlib\Traits\GetValidationTrait;
use Thirty98\API\Stdlib\Services\ResponseService;
use Illuminate\Http\Request;
use Closure;

abstract class AbstractGetMiddleware
{
    use GetValidationTrait;
    
    /**
     * Default Laravel Middleware function
     * @see http://laravel.com/docs/5.1/middleware#defining-middleware
     * 
     * @param Request $request
     * @param Closure $next
     * @return Closure
     */
    public function handle(Request $request, Closure $next)
    {
        $payload = $request->all();
        
        $validator = $this->getRequestValidator($payload);
        if ($validator->fails()) {
            $response = ['error' => $validator->errors(), 'payload' => $payload];
            return ResponseService::success("Validation failed", $response, 200, "FAILED_VALIDATION");
        }
        
         /** 
         * NOTE: Assumed that this function will merge any configuration for your next request
         */
        $output = $this->updateRequest($payload);
        if (isset($output['error'])) {
            $data = ['errors' => $output['error']['message'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }
        
        $request->replace($output);        
        unset($payload, $validator, $output); //garbage collection
        
        /**
         * NOTE: this is a closure function. It will error if you directly return $next($request->replace($output))
         */
        return $next($request);
    }
    
    /**
     * Rules that needs to be validated
     * 
     * @return Array Laravel Validation Rules
     * @see http://laravel.com/docs/5.1/validation#available-validation-rules
     */
    abstract protected function getValidationRules();
    
    /**
     * Used to update the current request parameters
     * 
     * @return Array
     * @param Array $payload Request object that is converted into Array using $request->all() method
     */
    abstract protected function updateRequest(Array $payload);
}