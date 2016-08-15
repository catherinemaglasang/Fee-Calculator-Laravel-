<?php

namespace Thirty98\API\Texas\Entities;

use Thirty98\API\General\Contracts\CalculationLoaderInterface;
use Thirty98\API\General\Contracts\CalculatorInterface;
use Thirty98\API\General\Entities\ApiException;
use Thirty98\API\General\Entities\ApiResponse;
use Thirty98\API\Texas\Entities\Calculators\BusCityBus;
use Thirty98\API\Texas\Entities\Calculators\BusMotorBus;
use Thirty98\API\Texas\Entities\Calculators\BusPrivateBus;
use Thirty98\API\Texas\Entities\Calculators\ExemptExemptVehicle;
use Thirty98\API\Texas\Entities\Calculators\MotorcycleAtvTypeVehicle;
use Thirty98\API\Texas\Entities\Calculators\MotorcycleMiniBike;
use Thirty98\API\Texas\Entities\Calculators\MotorcycleMoped;
use Thirty98\API\Texas\Entities\Calculators\MotorcycleMotorcycle;
use Thirty98\API\Texas\Entities\Calculators\MotorcycleOffRoadMotorcycle;
use Thirty98\API\Texas\Entities\Calculators\PassengerPassenger;
use Thirty98\API\Texas\Entities\Calculators\RecreationalMotorHome;
use Thirty98\API\Texas\Entities\Calculators\RecreationalTravelTrailer;
use Thirty98\API\Texas\Entities\Calculators\TrailerTokenTrailer;
use Thirty98\API\Texas\Entities\Calculators\TrailerTrailer;
use Thirty98\API\Texas\Entities\Calculators\TrailerUtilityTrailer;
use Thirty98\API\Texas\Entities\Calculators\Truck12PickupTruck;
use Thirty98\API\Texas\Entities\Calculators\Truck14PickupTruck;
use Thirty98\API\Texas\Entities\Calculators\Truck1TonPickupTruck;
use Thirty98\API\Texas\Entities\Calculators\Truck34PickupTruck;
use Thirty98\API\Texas\Entities\Calculators\TruckCombinationTruck;
use Thirty98\API\Texas\Entities\Calculators\TruckPickupTruck1Ton;
use Thirty98\API\Texas\Entities\Calculators\TruckSUVTruckPlates;
use Thirty98\API\Texas\Entities\Calculators\TruckTruckTractor;
use Thirty98\API\Texas\Entities\Calculators\TruckVanTruckPlates;
use Thirty98\API\Texas\Entities\Calculators\VintageCollectorVehicle;
use Thirty98\API\Texas\Entities\Calculators\CarCar;

class CalculatorLoader implements CalculationLoaderInterface
{
    private $input;
    private $calculatorMap;

    public function __construct(CalculatorInput $input)
    {
        $this->input = $input;

        // Set calculator mapping.
        $this->calculatorMap = [
            'car' => [
                'car' => CarCar::class
            ],
            'passenger' => [
                'passenger' => PassengerPassenger::class,
            ],
            'truck' => [
                'van-truck-plates' => TruckVanTruckPlates::class,
                'suv-truck-plates' => TruckSUVTruckPlates::class,
                '1-4-pickup-truck' => Truck14PickupTruck::class,
                '1-2-pickup-truck' => Truck12PickupTruck::class,
                '3-4-pickup-truck' => Truck34PickupTruck::class,
                '1-ton-pickup-truck' => Truck1TonPickupTruck::class,
                'pickup-truck-1-ton' => TruckPickupTruck1Ton::class,
                'truck-tractor' => TruckTruckTractor::class,
                'combination-truck' => TruckCombinationTruck::class,
            ],
            'bus' => [
                'city-bus' => BusCityBus::class,
                'private-bus' => BusPrivateBus::class,
                'motor-bus' => BusMotorBus::class,
            ],
            'motorcycle' => [
                'moped' => MotorcycleMoped::class,
                'motorcycle' => MotorcycleMotorcycle::class,
                'off-road-motorcycle' => MotorcycleOffRoadMotorcycle::class,
                'mini-bike' => MotorcycleMiniBike::class,
                'atv-type-vehicle' => MotorcycleAtvTypeVehicle::class,
            ],
            'recreational' => [
                'motor-home' => RecreationalMotorHome::class,
                'travel-trailer' => RecreationalTravelTrailer::class,
            ],
            'trailer' => [
                'token-trailer' => TrailerTokenTrailer::class,
                'trailer' => TrailerTrailer::class,
                'utility-trailer' => TrailerUtilityTrailer::class,
            ],
            'vintage' => [
                'collector-vehicle' => VintageCollectorVehicle::class
            ],
            'exempt' => [
                'exempt-vehicle' => ExemptExemptVehicle::class
            ]
        ];

        return $this;
    }

    /**
     * Get list of category-type mapping or relationship.
     *
     * @return array
     */
    public function getMappings()
    {
        return $this->calculatorMap;
    }

    /**
     * Load calculation type.
     *
     * @param InputInterface $input
     * @return CalculatorInterface
     */
    public function get()
    {
        if (!array_key_exists($this->input->getCategory(), $this->getMappings())) {
            throw new ApiException(
                ApiResponse::CODE_BAD_REQUEST,
                'Invalid category.',
                null,
                ApiResponse::HTTPCODE_BAD_REQUEST
            );
        }

        if (!isset($this->getMappings()[$this->input->getCategory()][$this->input->getType()])) {
            throw new ApiException(
                ApiResponse::CODE_BAD_REQUEST,
                'Invalid type.',
                null,
                ApiResponse::HTTPCODE_BAD_REQUEST
            );
        }

        // Get calculator class and create a new instance.
        $calculationClass = $this->getMappings()[$this->input->getCategory()][$this->input->getType()];
        $calculationClass = new $calculationClass($this->input);

        if (!$calculationClass instanceof CalculatorInterface) {
            throw new ApiException(
                ApiResponse::CODE_BAD_REQUEST,
                'Your calculator is not an implementation of CalculatorInterface.',
                null,
                ApiResponse::HTTPCODE_BAD_REQUEST
            );
        }

        return $calculationClass;
    }
}

#END OF PHP FILE