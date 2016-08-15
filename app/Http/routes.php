<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/******************************
 * API ROUTES STABLE VERSION
 *****************************/
Route::group(['prefix' => 'api'], function () {

    // Main Calculator Route and Configuration (version 1.x)
    // NOTE: DO NOT EDIT ANYTHING IF NOT FAMILIAR
    Route::group(
        ["prefix" => "calculator/v1"],
        function () {

            Route::get(
                "lateFeeRules",
                [
                    "uses" => "\Thirty98\API\Calculator\Controllers\CalculatorController@getStateRules"
                ]
            );

            // Calculator Route
            Route::post(
                "calculate",
                [
                    "middleware" => [
                        "state",
                        "transaction.types",
                        "vehicle.types",
                        "state.vehicle.types",
                        "state.transaction.types",
                        "pos.transaction.types",
                        "pos.plate.type",
                        "pos.codes",
                        "vehicle.plate.types",
                        "state.vehicle.plate.types",
                        "geo.location",
                        "inspection.fee",
                        "fees.factory",
                    ],
                    "as" => "api.calculator",
                    "uses" => "\Thirty98\API\Calculator\Controllers\CalculatorController@calculate"
                ]
            );

            Route::post(
                "calculateLateFees",
                [
                    "middleware" => [
                        "state",
                        "vehicle.types",
                        "state.vehicle.types",
                        "geo.location",
                        "fees.late.fees.factory",
                        "transaction.types"

                        // New middlewares
                        // "state.transaction.types",
                        // "vehicle.plate.types",
                        // "state.vehicle.plate.types",

                        // "inspection.fee",

                    ],
                    "as" => "api.calculator",
                    "uses" => "\Thirty98\API\Calculator\Controllers\CalculatorController@calculate"
                ]
            );

            Route::post(
                "batchCalculateFees",
                [
                    "middleware" => [
                        "batch.fees.factory"
                    ],
                    "as" => "api.calculator",
                    "uses" => "\Thirty98\API\Calculator\Controllers\CalculatorController@batchCalculateFees"
                ]
            );

            Route::post(
                "batchCalculateLateFees",
                [
                    "middleware" => [
                        "batch.late.fees.factory"
                    ],
                    "as" => "api.calculator",
                    "uses" => "\Thirty98\API\Calculator\Controllers\CalculatorController@batchCalculateLateFees"
                ]
            );

            // DUMMY Calculator Route
            Route::post(
                "calculate2",
                [
                    // Add complete middlewares
                    "middleware" => [
                        "state",
                        "transaction.types",
                        "vehicle.types",
                        "state.vehicle.types",
                        "state.transaction.types",
                        "sales.tax.rate",

                        // New middlewares
                        "transaction.types",
                        "state.transaction.types",
                        "vehicle.plate.types",
                        "state.vehicle.plate.types",
                        "geo.location",
                        "fees.factory"
                    ],
                    "as" => "api.calculator",
                    "uses" => "\Thirty98\API\Calculator\Controllers\CalculatorController@calculate"
                ]
            );

            // Calculator log.
            Route::post(
                "log",
                [
                    // Add complete middlewares
                    "middleware" => [
                        "state",
                        "log"
                    ],
                    "uses" => "\Thirty98\API\Calculator\Controllers\CalculatorController@log"
                ]
            );

            // Calculator log.
            Route::post(
                "logs",
                [
                    // Add complete middlewares
                    "middleware" => [
                        "state",
                        "log.query"
                    ],
                    "uses" => "\Thirty98\API\Calculator\Controllers\CalculatorController@getLogs"
                ]
            );

            // Configuration route
            Route::post(
                "configuration",
                [
                    "middleware" => [
                        "state"
                    ],
                    "as" => "api.calculator.configuration",
                    "uses" => "\Thirty98\API\Calculator\Controllers\CalculatorConfigurationController@configure"
                ]
            );

            Route::post(
                "configuration2",
                [
                    "middleware" => [
                        "cors",
                        "state",
                        "transaction.types",
                        "state.transaction.types",
                        "vehicle.types.configuration"
                    ],
                    "as" => "api.calculator.configuration",
                    "uses" => "\Thirty98\API\Calculator\Controllers\CalculatorConfigurationController@configure2"
                ]
            );

            Route::post(
                "fees",
                [
                    "middleware" => [
                        "state",
                        "transaction.types",
                        "state.transaction.types"
                    ],
                    "as" => "api.calculator.configuration",
                    "uses" => "\Thirty98\API\Calculator\Controllers\CalculatorConfigurationController@configure2"
                ]
            );
        }
    );

    // Main Transaction Types API Route and Configuration (version 1.x)
    // NOTE: DO NOT EDIT ANYTHING IF NOT FAMILIAR
    Route::group(
        ["prefix" => "transaction/v1"],
        function () {
            Route::get(
                "types",
                [
                    "as" => "transaction.type",
                    "uses" => "\Thirty98\API\Calculator\Controllers\TransactionTypeController@getTypes"
                ]
            );
            Route::post(
                "state/type",
                [
                    "as" => "state.transaction.types",
                    "middleware" => [
                        "state"
                    ],
                    "uses" => "\Thirty98\API\Calculator\Controllers\TransactionTypeController@postStateTypes"
                ]
            );
        }
    );

    Route::group(
        ['prefix' => "pos/v1"],
        function () {

            Route::get(
                "states/north_america",
                [
                    "uses" => "\Thirty98\API\POS\Controllers\POSController@getNorthAmericanStates"
                ]
            );

            Route::get(
                "license/plate",
                [
                    "middleware" => [
                        "pos.prefix"
                    ],
                    "as" => "api.vehicle.plate.types",
                    "uses" => "\Thirty98\API\POS\Controllers\POSController@getLicensePlateDetails"
                ]
            );

            Route::get(
                "transaction_type/defaults",
                [
                    "middleware" => [
                        "pos.transaction.type"
                    ],
                    "uses" => "\Thirty98\API\POS\Controllers\POSController@getTransactionTypeDefaults"
                ]
            );

            Route::post(
                "vehicle/types",
                [
                    "middleware" => [
                        "pos.prefix"
                    ],
                    "as" => "api.vehicle.plate.types",
                    "uses" => "\Thirty98\API\POS\Controllers\POSController@getPOSLATables"
                ]
            );
        }
    );

    // Main Vehicle API and Configuration - including DataOne validation (version 1.x)
    // NOTE: DO NOT EDIT ANYTHING IF NOT FAMILIAR
    Route::group(
        ['prefix' => "vehicle/v1"],
        function () {

            Route::post(
                "types",
                [
                    "middleware" => [
                        "state",
                        "vehicle.types.state"
                    ],
                    "as" => "api.vehicle.types",
                    "uses" => "\Thirty98\API\Vehicle\Controllers\VehicleController@getTypesByState"
                ]
            );

            Route::post(
                "inspectionTypes",
                [
                    "uses" => "\Thirty98\API\Vehicle\Controllers\VehicleController@getInspectionFees"
                ]
            );

            Route::post(
                "geoLocationRates",
                [
                    "middleware" => [
                        "state",
                        "zip.geo.location", // I need a middleware that returns a count and city based on the street address and zip code.
                        // "geo.location"
                    ],
                    "uses" => "\Thirty98\API\Vehicle\Controllers\VehicleController@getGeoLocationRates"
                ]
            );

            Route::post(
                "inspectionTypeByCode",
                [
                    "middleware" => [
                        "inspection.fees"
                    ],
                    "uses" => "\Thirty98\API\Vehicle\Controllers\VehicleController@getInspectionFeeBycode"
                ]
            );

            Route::post(
                "inspectionTypesFiltered",
                [
                    "middleware" => [
                        "inspection.fee.filter"
                    ],
                    "uses" => "\Thirty98\API\Vehicle\Controllers\VehicleController@getFilteredInspectionFee"
                ]
            );

            Route::post(
                "plate/types/state",
                [
                    "middleware" => [
                        "state"
                    ],
                    "as" => "api.vehicle.plate.types",
                    "uses" => "\Thirty98\API\Vehicle\Controllers\VehicleController@getPlateTypesByState"
                ]
            );

            /**
             * @todo correct RESTful path
             */
            Route::post(
                "plate/types/vehicleAndState",
                [
                    "middleware" => [
                        "state",
                        "vehicle.types",
                        "state.vehicle.types"
                    ],
                    "as" => "api.vehicle.plate.types",
                    "uses" => "\Thirty98\API\Vehicle\Controllers\VehicleController@getPlateTypesByStateAndVehicle"
                ]
            );

            Route::get(
                "fuelTypes/{state}",
                [
                    "middleware" => [
                        // "state"
                    ],
                    "as" => "api.vehicle.plate.types",
                    "uses" => "\Thirty98\API\Vehicle\Controllers\VehicleController@getFuelTypes"
                ]
            );

            /**
             * @todo For removal
             */
            Route::get(
                "plate/test",
                [
                    "middleware" => [
                        /*"state",
                        "vehicle.types",
                        "state.vehicle.types",
                        "transaction.types",
                        "state.transaction.types",
                        "vehicle.plate.types",
                        "state.vehicle.plate.types",
                        "geo.location",
                        "fees.factory"*/
                    ],
                    "as" => "api.vehicle.plate.types",
                    "uses" => "\Thirty98\API\Vehicle\Controllers\VehicleController@funcTest"
                ]
            );

            Route::get(
                "plate/test2",
                [
                    "middleware" => [
                        /*"state",
                        "vehicle.types",
                        "state.vehicle.types",
                        "transaction.types",
                        "state.transaction.types",
                        "vehicle.plate.types",
                        "state.vehicle.plate.types",
                        "geo.location",
                        "fees.factory"*/
                    ],
                    "as" => "api.vehicle.plate.types",
                    "uses" => "\Thirty98\API\Vehicle\Controllers\VehicleController@funcTest2"
                ]
            );

            Route::post(
                "plate/test3",
                [
                    "middleware" => [
                        /*"state",
                        "vehicle.types",
                        "state.vehicle.types",
                        "transaction.types",
                        "state.transaction.types",
                        "vehicle.plate.types",
                        "state.vehicle.plate.types",
                        "geo.location",
                        "fees.factory"*/
                    ],
                    "as" => "api.vehicle.plate.types",
                    "uses" => "\Thirty98\API\Vehicle\Controllers\VehicleController@funcTestPost"
                ]
            );

            Route::post(
                "plate/test4",
                [
                    "middleware" => [
                        /*"state",
                        "vehicle.types",
                        "state.vehicle.types",
                        "transaction.types",
                        "state.transaction.types",
                        "vehicle.plate.types",
                        "state.vehicle.plate.types",
                        "geo.location",
                        "fees.factory"*/
                    ],
                    "as" => "api.vehicle.plate.types",
                    "uses" => "\Thirty98\API\Vehicle\Controllers\VehicleController@funcTestPostReturn"
                ]
            );

            /**
             * @todo For removal
             */
            /*Route::post(
                "TX/inspectionFees/{county_code}",
                [
                    "middleware" => [
                        "state",
                        "vehicle.types",
                        "state.vehicle.types",
                        "inspection.fee.filter"
                    ],
                    "as" => "api.vehicle.plate.types",
                    "uses" => "\Thirty98\API\Vehicle\Controllers\VehicleController@getTXInspectionOptions"
                ]
            );*/
        }
    );

    Route::group(
        ['prefix' => "dataone/v1"],
        function () {
            Route::post(
                "vinpattern",
                [
                    "as" => "api.dataone.vinpattern",
                    "uses" => "\Thirty98\API\DataOne\Controllers\DataOneController@vinPattern"
                ]
            );

            Route::post(
                "vehicle",
                [
                    "as" => "api.dataone.vehicles",
                    "uses" => "\Thirty98\API\DataOne\Controllers\DataOneController@vehicleInfo"
                ]
            );

            Route::get(
                "/vehicle/body/types",
                [
                    "as" => "api.dataone.vehicles",
                    "uses" => "\Thirty98\API\DataOne\Controllers\DataOneController@getBodyTypes"
                ]
            );
        }
    );

    Route::group(
        ['prefix' => "avalara/v1"],
        function () {

            Route::post(
                "verify/location",
                [
                    "as" => "api.avalara.verify.location",
                    "middleware" => [
                        "zip",
                        "street_address"
                    ],
                    "uses" => "\Thirty98\API\Avalara\Controllers\AvalaraController@verifyLocation"
                ]
            );
        }
    );
});


Route::get('/', 'SessionsController@login');

Route::get('register', 'RegistrationController@register');
Route::post('register', 'RegistrationController@postRegister');
Route::get('register/confirm/{token}', 'RegistrationController@confirmEmail');
Route::get('login', ['as' => 'login', 'uses' => 'SessionsController@login']);
Route::post('login', 'SessionsController@postLogin');
Route::get('logout', ['as' => 'logout', 'uses' => 'SessionsController@logout']);

/********************************
 *  UI ROUTE STABLE VERSION 1.x
 ********************************/

//Route::get('calculator/{state_code}', "DashboardController@useCalculator");

Route::group(['prefix' => 'calculator'], function () {
    Route::get('/', ['uses' => 'DashboardController@useCalculator']);
    Route::get('main', ['uses' => 'CalculatorController@main']);
    Route::get('logs', ['uses' => 'CalculatorController@logs']);
    Route::get('TX', ['uses' => 'CalculatorController@useCalculatorTexas']);

    Route::get('AR', ['uses' => 'CalculatorController@useCalculatorArkansas']);

    Route::get('DE', ['uses' => 'CalculatorController@useCalculatorDelaware']);
    Route::post('DE', ['uses' => 'Calculations\DelawareCalculationsController@mainCalculations']);

    // GG.
    Route::get('LA2', ['uses' => 'CalculatorController@useCalculatorLouisiana2']);

    Route::get('LA', ['uses' => 'CalculatorController@useCalculatorLouisiana']);
    Route::post('LA', ['uses' => 'Calculations\LouisianaCalculationsController@mainCalculations']);
});

/********************************
 *  API Routes for calculator manager
 *  Version: 1.0
 ********************************/

Route::group(['prefix' => 'api/manage'], function () {

    // Get Types
    Route::get('types/{categoryId}', ['uses' => 'Manage\ManageDataController@getTypeByCategoryId']);
    Route::get('categories', ['uses' => 'Manage\ManageDataController@getCategories']);

    // Get Louisiana Data.
    Route::get('TTLtypes/{stateCode}', ['uses' => 'Manage\ManageDataController@getTTLTypes']);
    Route::get('plateTypes/{stateCode}/{type}', ['uses' => 'Manage\ManageDataController@getPlateTypes']);

    // Get Fees
    Route::get('fees/state/{stateId}/{categoryTypeId}', ['uses' => 'Manage\ManageDataController@getFeesByState']);
    Route::get('fees/county/{countyId}/{categoryTypeId}', ['uses' => 'Manage\ManageDataController@getFeesByCounty']);

    // Get City Fees.
    // /state
    Route::get('citiesFees/state/{stateName}', ['uses' => 'Manage\ManageDataController@getCitiesFeesBySate']);

    // Get Penalties
    Route::get('penalties/state/{stateId}/{categoryTypeId}', ['uses' => 'Manage\ManageDataController@getPenaltiesByState']);
    Route::get('penalties/county/{countyId}/{categoryTypeId}', ['uses' => 'Manage\ManageDataController@getPenaltiesByCounty']);

    // Get Tax
    Route::get('tax/state/{stateId}/{categoryTypeId}', ['uses' => 'Manage\ManageDataController@getTaxByState']);
    Route::get('tax/county/{countyId}/{categoryTypeId}', ['uses' => 'Manage\ManageDataController@getTaxByCounty']);
    Route::get('tax/dateValidation/{dateOfSale}', ['uses' => 'Manage\ManageDataController@getDateStatus']);

    // Get Dates
    Route::get('dates/state/{stateId}/{feeType}', ['uses' => 'Manage\ManageDataController@getDatesByState']);

    // Update fees
    Route::post('update/state/table/{stateId}/{feeId}/{categoryTypeId}/{amount}', ['uses' => 'Manage\ManageUpdateController@updateStateTable']);
    Route::post('update/county/table/{countyId}/{feeId}/{categoryTypeId}/{amount}', ['uses' => 'Manage\ManageUpdateController@updateCountyFee']);
    Route::post('update/dates/table/{request}', ['uses' => 'Manage\ManageUpdateController@updateDates']);

    // Add update cities fees
    Route::post('update/updateCityFees/{cityId}/{feeId}/{newFeeAmount}/{startDate}/{endDate}', ['uses' => 'Manage\ManageUpdateController@updateCityFees']);
    Route::get('parishes', ['uses' => 'Manage\ManageDataController@getParishes']);
    Route::get('city/getByState/{stateName}', ['uses' => 'Manage\ManageDataController@getCitiesByState']);
    Route::get('city/getByParish/{parishName}', ['uses' => 'Manage\ManageDataController@getCitiesByParish']);
    Route::post('stateTypes/{stateCode}', ['uses' => 'Manage\ManageDataController@getTypesByCode']);

    // get states
    Route::get('states', ['uses' => 'Manage\ManageDataController@getStates']);
});

/********************************
 *  API Routes
 *  Version: 1.0
 ********************************/
// Route::group(['middleware' => 'auth.api', 'prefix' => 'api/v1'], function () {
Route::group(['prefix' => 'api/v1'], function () {
    // Locations.
//    Route::get('locations', ['uses' => '\Thirty98\API\General\Controllers\LocationController@show']);

    // Avalara.

    // Temporary Avalara.

//    Route::get('avalara/louisianarates', ['uses' => '\Thirty98\API\General\Controllers\AvalaraController@getAvalaraTaxRate']);
//    Route::get('avalara/rates', ['uses' => '\Thirty98\API\General\Controllers\AvalaraController@getSalesTaxRate']);
//    Route::get('avalara/ratesLocal', ['uses' => '\Thirty98\API\General\Controllers\AvalaraController@getLouisianaSalesTaxRate2']);
//    Route::get('avalara/verify', ['uses' => '\Thirty98\API\General\Controllers\AvalaraController@checkLocation']);

    // VIN Patterns.
//    Route::get('vinpatterns/{vin}', ['uses' => '\Thirty98\API\General\Controllers\VinController@index']);

    // Categories.
//    Route::get('categories', ['uses' => '\Thirty98\API\General\Controllers\CategoryController@index']);
//    Route::get('categories/{id}/types', ['uses' => '\Thirty98\API\General\Controllers\CategoryController@getTypes']);

    // Calculator.
//    Route::post('calculate/{stateCode}', ['uses' => '\Thirty98\API\General\Controllers\CalculatorController@postCalculate']);

    // Countries.
    Route::get('countries', ['uses' => '\Thirty98\API\General\Controllers\CountryController@index']);

    // States
    Route::get('states', ['uses' => '\Thirty98\API\General\Controllers\StateController@index']);
    Route::get('state/{state_code}/vehicle/types', ['uses' => "\Thirty98\API\Stdlib\Controllers\StateController@getVehicleTypes"]);
    Route::get('state/{state_code}/vehicle/inspection/types', ['uses' => "\Thirty98\API\Stdlib\Controllers\StateController@getInspectionTypes"]);

    // Route::get('state/{state_code}/{vehicle_type}/vehicle/body/types', ['uses' => "\Thirty98\API\Stdlib\Controllers\StateController@getVehicleBodyTypes"]);

    Route::get(
        "vehicle/body/types",
        [
            "middleware" => [
                "state",
                "vehicle.types"
            ],
            "uses" => "\Thirty98\API\Stdlib\Controllers\StateController@getVehicleBodyTypes"
        ]
    );


    Route::get('state/{state_code}/vehicle/body/colors', ['uses' => "\Thirty98\API\Stdlib\Controllers\StateController@getVehicleColors"]);
    Route::get('state/{state_code}/{county_code}/cities', ['uses' => "\Thirty98\API\Stdlib\Controllers\StateController@getStateCountyCities"]);
    Route::get('state/{state_code}/sales/tax', ['uses' => "\Thirty98\API\Stdlib\Controllers\StateController@getSalesTax"]);
    Route::get('state/{state_code}/sales/tax/exempt', ['uses' => "\Thirty98\API\Stdlib\Controllers\StateController@getSalesTaxExempt"]);
    Route::get('state/{state_code}/vehicle/ownership', ['uses' => "\Thirty98\API\Stdlib\Controllers\StateController@getVehicleOwnership"]);

    Route::get('state/{state_code}/fuel/types', ['uses' => "\Thirty98\API\Stdlib\Controllers\StateController@getFuelTypes"]);

    // Counties
    Route::get('counties', ['uses' => '\Thirty98\API\General\Controllers\CountyController@index']);
    Route::get('state/{stateCode}/counties', ['uses' => '\Thirty98\API\General\Controllers\CountyController@getStateCounties']);


    // Cities.
    Route::get('cities', ['uses' => '\Thirty98\API\General\Controllers\CityController@index']);

    // TTL Types
//    Route::get('ttltypes', ['uses' => '\Thirty98\API\General\Controllers\TtlTypeController@index']);

    // Calculate Gross Vehicle Weight.
//    Route::get('grossvehicleweight/{vehicleId}', ['uses' => '\Thirty98\API\General\Controllers\GrossVehicleWeightController@show']);
});

Route::macro('after', function ($callback) {
    $this->events->listen('router.filter:after:newrelic-patch', $callback);
});