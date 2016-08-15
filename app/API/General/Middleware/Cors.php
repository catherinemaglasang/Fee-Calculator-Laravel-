<?php

namespace Thirty98\API\General\Middleware;

use Illuminate\Http\Request;
use Closure;

class Cors
{
    protected $service;

    public function __construct()
    {

    }

    /**
     * Filters TTL TYPE and get the Fee Calculator configuration on what taxes/fees are to be displayed
     *
     * @param Request $request
     * @param Closure $next
     * @return Request
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin', $_SERVER['HTTP_ORIGIN'])
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Max-Age', '1000')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
    }

}
