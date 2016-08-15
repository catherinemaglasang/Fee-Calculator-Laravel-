<?php

namespace Thirty98\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Thirty98\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        "auth"                          => \Thirty98\Http\Middleware\Authenticate::class,
        "auth.basic"                    => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        "guest"                         => \Thirty98\Http\Middleware\RedirectIfAuthenticated::class,
        "csrf"                          => \Thirty98\Http\Middleware\VerifyCsrfToken::class,
        "auth.api"                      => \Thirty98\Http\Middleware\AuthApi::class,

        "state"                         => \Thirty98\API\Stdlib\Middleware\StateMiddleware::class,
        "fee"                           => \Thirty98\API\Stdlib\Middleware\FeeMiddleware::class,
        "log"                           => \Thirty98\API\Stdlib\Middleware\LogMiddleware::class,
        "log.query"                     => \Thirty98\API\Stdlib\Middleware\LogQueryMiddleware::class,
        "fee.state"                     => \Thirty98\API\Stdlib\Middleware\StateFeeMiddleware::class,
        "sales.tax.rate"                => \Thirty98\API\Calculator\Middleware\SalesTaxRateMiddleware::class,

        //masterlist validations
        //"vehicle"                     => \Thirty98\API\Stdlib\Middleware\VehicleMiddleware::class,
        "zip.geo.location"              => \Thirty98\API\Stdlib\Middleware\ZipGeoLocationMiddleware::class,

        "zip"                           => \Thirty98\API\Stdlib\Middleware\ZipMiddleware::class,
        "street_address"                => \Thirty98\API\Stdlib\Middleware\StreetAddressMiddleware::class,


        "geo.location"                  => \Thirty98\API\Stdlib\Middleware\GeoLocationMiddleware::class,
        "vehicle.types"                 => \Thirty98\API\Vehicle\Middleware\VehicleTypesMiddleware::class,
        "state.vehicle.types"           => \Thirty98\API\Vehicle\Middleware\VehicleTypesStateMiddleware::class,
        "vehicle.plate.types"           => \Thirty98\API\Vehicle\Middleware\VehiclePlateTypesMiddleware::class,
        "state.vehicle.plate.types"     => \Thirty98\API\Vehicle\Middleware\VehiclePlateTypesStateMiddleware::class,

        "transactions"                  => \Thirty98\API\Calculator\Middleware\TransactionTypeMiddleware::class, // validates State transaction types if existing
        "transaction.types"             => \Thirty98\API\Calculator\Middleware\TransactionTypeMiddleware::class, //validates transaction code
        "state.transaction.types"       => \Thirty98\API\Calculator\Middleware\TransactionTypeStateMiddleware::class,
        "pos.transaction.types"         => \Thirty98\API\Calculator\Middleware\POSTransactionTypeMiddleware::class,
        "inspection.fee"                => \Thirty98\API\Stdlib\Middleware\InspectionFeeMiddleware::class,

        // Fees Middleware
        "fees.factory"                  => \Thirty98\API\Calculator\Middleware\FeesFactoryMiddleware::class,
        "fees.late.fees.factory"        => \Thirty98\API\Calculator\Middleware\FeesFactoryLateFeesMiddleware::class,
        "batch.fees.factory"            => \Thirty98\API\Calculator\Middleware\BatchCalculateFeesMiddleware::class,
        "batch.late.fees.factory"       => \Thirty98\API\Calculator\Middleware\BatchCalculateLateFeesMiddleware::class,
        "inspection.fees"               => \Thirty98\API\Stdlib\Middleware\InspectionFeesMiddleware::class,
        "inspection.fee.filter"         => \Thirty98\API\Calculator\Middleware\Texas\InspectionFeeFilterMiddleware::class,

        /**
         * For configuration.
         */
        "vehicle.types.configuration"        => \Thirty98\API\Vehicle\Middleware\VehicleTypesConfigurationMiddleware::class,
        "transaction.types.configuration"   => \Thirty98\API\Calculator\Middleware\TransactionTypeConfigurationMiddleware::class, //validates transaction code

        /**
         * Cross origin resource sharing
         */
        "cors"                          => \Thirty98\API\General\Middleware\Cors::class,

        /**
         * POS Routes.
         */

        "pos.prefix"                    => \Thirty98\API\POS\Middleware\PrefixMiddleware::class,
        "pos.plate.type"                => \Thirty98\API\POS\Middleware\POSMiddleware::class,
        "pos.codes"                     => \Thirty98\API\POS\Middleware\POSCodesMiddleware::class,
        "pos.transaction.type"          => \Thirty98\API\POS\Middleware\TransactionTypesMiddleware::class,

        // End of Fees Middleware

        //"dataone"                   => \Thirty98\API\DataOne\Middleware\DataOneMiddleware::class, //use vehicle middleware
        //"dataone.vehicle.types"     => \Thirty98\API\DataOne\Middleware\DataOneMiddleware::class, //use vehicle middleware 
    ];
}