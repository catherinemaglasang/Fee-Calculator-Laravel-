<?php

namespace Thirty98\Http\Middleware;

use Closure;
use Thirty98\API\General\Entities\ApiResponse;

class AuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $apiKey = $request->get('api_key');

        if ($apiKey !== env('API_KEY')) {
            return ApiResponse::error(
                ApiResponse::CODE_FORBIDDEN,
                'You are not authorized to access this resource.' . env('API_KEY') . 'Submitted is: ' . $apiKey,
                null,
                ApiResponse::HTTPCODE_FORBIDDEN
            );
        }

        return $next($request);
    }
}
