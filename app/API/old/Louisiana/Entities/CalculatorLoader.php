<?php

namespace Thirty98\API\Louisiana\Entities;

use Thirty98\API\General\Contracts\CalculationLoaderInterface;
use Thirty98\API\General\Contracts\CalculatorInterface;
use Thirty98\API\General\Entities\ApiException;
use Thirty98\API\General\Entities\ApiResponse;
use Thirty98\API\Louisiana\Entities\Calculators\CollectorVehicleCollectorVehicle;
use Thirty98\API\Louisiana\Entities\Calculators\CommercialCommercial;
use Thirty98\API\Louisiana\Entities\Calculators\MotorcycleMotorcycle;
use Thirty98\API\Louisiana\Entities\Calculators\MotorHomeRecreational;
use Thirty98\API\Louisiana\Entities\Calculators\OffRoadOffRoad;
use Thirty98\API\Louisiana\Entities\Calculators\CarCar;
use Thirty98\API\Louisiana\Entities\Calculators\PrivateBusBus;
use Thirty98\API\Louisiana\Entities\Calculators\SemiTrailerTrailer;
use Thirty98\API\Louisiana\Entities\Calculators\SUVSUV;
use Thirty98\API\Louisiana\Entities\Calculators\Trailer1YLicenseTrailer;
use Thirty98\API\Louisiana\Entities\Calculators\Trailer4YLicenseTrailer;
use Thirty98\API\Louisiana\Entities\Calculators\TrailerBoatTrailer;
use Thirty98\API\Louisiana\Entities\Calculators\TrailerTrailer;
use Thirty98\API\Louisiana\Entities\Calculators\TrailerUtilityTrailer;
use Thirty98\API\Louisiana\Entities\Calculators\TruckTractorTruckTractor;
use Thirty98\API\Louisiana\Entities\Calculators\TruckTruck;
use Thirty98\API\Louisiana\Entities\Calculators\VanVan;

class CalculatorLoader implements CalculationLoaderInterface
{
    private $input;
    private $calculatorMap;

    public function __construct(CalculatorInput $input)
    {
        $this->input = $input;

        // Set calculator mapping.
        $this->calculatorMap = [
            "bus" => [
                 "private-bus" => PrivateBusBus::class
            ],

            "commercial" => [
                "commercial" => CommercialCommercial::class
            ],

            "collector-vehicle" => [
                "collector-vehicle" => CollectorVehicleCollectorVehicle::class
            ],

            "recreational" => [
                "motor-home" => MotorHomeRecreational::class
            ],

            "motorcycle" => [
                "motorcycle" => MotorcycleMotorcycle::class
            ],

            "off-road" => [
                "off-road" => OffRoadOffRoad::class
            ],

            "SUV" => [
                "SUV" => SUVSUV::class
            ],

            "car" => [
                "car" => CarCar::class
            ],

            "truck" => [
                "truck" => TruckTruck::class
            ],

            "truck-tractor" => [
                "truck-tractor" => TruckTractorTruckTractor::class
            ],

            "trailer" => [
                "boat-trailer" => TrailerBoatTrailer::class,
                "utility-trailer" => TrailerUtilityTrailer::class,
                "trailer" => TrailerTrailer::class,
                "trailer-1y license" => Trailer1YLicenseTrailer::class,
                "trailer-4y license" => Trailer4YLicenseTrailer::class,
                "semi-trailer" => SemiTrailerTrailer::class
            ],

            "van" => [
                "van" => VanVan::class
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