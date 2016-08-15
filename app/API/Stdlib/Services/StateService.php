<?php

namespace Thirty98\API\Stdlib\Services;

use Thirty98\API\Stdlib\Models\State;
use Illuminate\Support\Facades\DB;
use Thirty98\API\Vehicle\Services\VehicleService;
use Thirty98\Models\BodyStyles;
use Thirty98\Models\LABodyStyles;

class StateService
{
    protected $model;
    protected $vehicle_service;

    public function __construct(State $model, VehicleService $vehicle_service)
    {
        $this->model = $model;
        $this->vehicle_service = $vehicle_service;
    }

    public function fetchByCode($code)
    {
        return $this->model->where("code", $code);
    }

    public function getTransactionTypes($state)
    {

    }

    public function getInspectionTypes($state)
    {
        if (!in_array(strtoupper($state), ["TX", "LA"])) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No data found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No corresponding inspection types for {$state}"
                ]
            ];
        }

        $types = [
            "TX" => [
                ["code" => "1YR", "title" => "One Year Safety Inspection Only - 1YR", "description" => "One Year Safety Inspection Only"],
                ["code" => "2YR", "title" => "Two Year Safety Inspection Only - 2YR", "description" => "Two Year Safety Inspection Only"],
                ["code" => "CW", "title" => "Commercial/Windshield Inspection - CW", "description" => "Commercial/Windshield Inspection"],
                ["code" => "CDEC", "title" => "Commercial/Decal Inspection - CDEC", "description" => "Commercial/Decal Inspection"],
                ["code" => "TLMC", "title" => "Trailer/Motorcycle Inspection - TLMC", "description" => "Trailer/Motorcycle Inspection"],
                ["code" => "TSI", "title" => "TSI Safety Emission Inspection - TSI", "description" => "TSI Safety Emission Inspection"],
                ["code" => "ASM", "title" => "ASM Safety Emission Inspection - ASM", "description" => "ASM Safety Emission Inspection"],
                ["code" => "OBD", "title" => "OBD Safety Emission Inspection - OBD", "description" => "OBD Safety Emission Inspection"],
                ["code" => "EMONLY", "title" => "Emission Inspection Only - EMONLY", "description" => "Emission Inspection Only"],
                ["code" => "EMONLY-ASM", "title" => "Emission Inspection Only - EMONLY-ASM", "description" => "Emission Inspection Only"],
                ["code" => "EMONLY-OBD", "title" => "Emission Inspection Only - EMONLY-OBD", "description" => "Emission Inspection Only"],
                ["code" => "TISOBD", "title" => "TSI/OBD Safety Emission - TISOBD", "description" => "TSI/OBD Safety Emission"],
                ["code" => "OBDNL", "title" => "OBD Safety Emission - No LIRAP - OBDNL", "description" => "OBD Safety Emission - No LIRAP"],
                ["code" => "NLTSI", "title" => "Travis/Williamson Emission - No LIRAP - NLTSI", "description" => "Travis/Williamson Emission - No LIRAP"],
                ["code" => "SOEO", "title" => "One Year Safety + Emissions Only - SOEO", "description" => "One Year Safety + Emissions Only"],
                ["code" => "CWEO", "title" => "Commercial/Windshield + Emission - CWEO", "description" => "Commercial/Windshield + Emission"]
            ],

            "LA" => [
                ["code" => "1YR", "title" => "One Year Safety Inspection Only - 1YR", "description" => "One Year Safety Inspection Only"],
                ["code" => "2YR", "title" => "Two Year Safety Inspection Only - 2YR", "description" => "Two Year Safety Inspection Only"],
                ["code" => "CW", "title" => "Commercial/Windshield Inspection - CW", "description" => "Commercial/Windshield Inspection"],
                ["code" => "CDEC", "title" => "Commercial/Decal Inspection - CDEC", "description" => "Commercial/Decal Inspection"],
                ["code" => "TLMC", "title" => "Trailer/Motorcycle Inspection - TLMC", "description" => "Trailer/Motorcycle Inspection"],
                ["code" => "TSI", "title" => "TSI Safety Emission Inspection - TSI", "description" => "TSI Safety Emission Inspection"],
                ["code" => "ASM", "title" => "ASM Safety Emission Inspection - ASM", "description" => "ASM Safety Emission Inspection"],
                ["code" => "OBD", "title" => "OBD Safety Emission Inspection - OBD", "description" => "OBD Safety Emission Inspection"],
                ["code" => "EMONLY", "title" => "Emission Inspection Only - EMONLY", "description" => "Emission Inspection Only"],
                ["code" => "EMONLY-ASM", "title" => "Emission Inspection Only - EMONLY-ASM", "description" => "Emission Inspection Only"],
                ["code" => "EMONLY-OBD", "title" => "Emission Inspection Only - EMONLY-OBD", "description" => "Emission Inspection Only"],
                ["code" => "TISOBD", "title" => "TSI/OBD Safety Emission - TISOBD", "description" => "TSI/OBD Safety Emission"],
                ["code" => "OBDNL", "title" => "OBD Safety Emission - No LIRAP - OBDNL", "description" => "OBD Safety Emission - No LIRAP"],
                ["code" => "NLTSI", "title" => "Travis/Williamson Emission - No LIRAP - NLTSI", "description" => "Travis/Williamson Emission - No LIRAP"],
                ["code" => "SOEO", "title" => "One Year Safety + Emissions Only - SOEO", "description" => "One Year Safety + Emissions Only"],
                ["code" => "CWEO", "title" => "Commercial/Windshield + Emission - CWEO", "description" => "Commercial/Windshield + Emission"]
            ]
        ];

        return $types[$state];
    }

    public function getCities($state, $code)
    {
        $cities = DB::table('cities')->join("counties", "counties.id", "=", "cities.county_id")
            ->where("counties.state_code", $state)
            ->where('counties.code', $code)
            ->select("cities.id", "cities.name", "cities.slug", "counties.name as county", "counties.state_code")
            ->get();

        if (count($cities) == 0) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No data found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No corresponding cities for {$state} {$code}"
                ]
            ];
        }

        return $cities;
    }

    public function getSalesTax($state)
    {
        if (!in_array(strtoupper($state), ["TX", "LA"])) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No data found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No corresponding sales tax for {$state}"
                ]
            ];
        }

        $data = [
            "TX" => [
                ["code" => "ET", "description" => "Even Trade Transfer Tax", "slug" => "even_trade_transfer_tax"],
                ["code" => "EX", "description" => "Exempt", "slug" => "exempt"],
                ["code" => "GT", "description" => "Gift Tax", "slug" => "gift_tax"],
                ["code" => "LP", "description" => "Lease and Lease Purchase", "slug" => "lease_andlease_purchase"],
                ["code" => "NR", "description" => "New Residence Tax", "slug" => "residence_tax"],
                ["code" => "SU", "description" => "Motor Vehicle Sales/Use Tax", "slug" => "motor_vehicle_sales_use_tax"],
            ],
            "LA" => [
                ["code" => "SU", "description" => "Sales/Use Tax", "slug" => "motor_vehicle_sales_use_tax"],
                ["code" => "OSRV", "description" => "O/S Off-Road (MS,OK,orTN)", "slug" => "out_of_state"],
                ["code" => "NRB", "description" => "Non-Resident Boat", "slug" => "non_resident_boat"],
                ["code" => "DR", "description" => "Dealer Resale", "slug" => "dealer_resale"],
                ["code" => "EX", "description" => "Exempt", "slug" => "exempt"],
            ]
        ];

        return $data[$state];
    }

    public function getVehicleOwnershipByState($state)
    {
        if (!in_array(strtoupper($state), ["TX", "LA"])) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No data found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No corresponding ownership evidence for {$state}"
                ]
            ];
        }

        $ownership = [
            "TX" => [
                ["code" => "0", "title" => "0 - NON-Titled", "description" => "Non-titled"],
                ["code" => "1", "title" => "1 - Texas Title", "description" => "Texas Title"],
                ["code" => "2", "title" => "2 - Texas Salvage Cert", "description" => "Texas Salvage Cert"],
                ["code" => "3", "title" => "3 - Out-of-State Title", "description" => "Out-of-State Title"],
                ["code" => "4", "title" => "4 - Out-of-State Salvage Cert", "description" => "Out-of-State Salvage Cert"],
                ["code" => "5", "title" => "5 - Government Bill of Sale", "description" => "Government Bill of Sale"],
                ["code" => "6", "title" => "6 - Manufacturer's Cert of Origin", "description" => "Manufacturer's Cert of Origin"],
                ["code" => "7", "title" => "7 - Form 97", "description" => "Form 97"],
                ["code" => "8", "title" => "8 - Foreign Evidence", "description" => "Foreign Evidence"],
                ["code" => "9", "title" => "9 - Court Order", "description" => "Court Order"],
                ["code" => "10", "title" => "10 - Title Hearing", "description" => "Title Hearing"],
                ["code" => "12", "title" => "12 - Certified Copy Texas Title", "description" => "Certified Copy Texas Title"],
                ["code" => "13", "title" => "13 - TX Duplicate Salvage Cert", "description" => "TX Duplicate Salvage Cert"],
                ["code" => "14", "title" => "14 - Bonded Title", "description" => "Bonded Title"],
                ["code" => "15", "title" => "15 - Heirship Form", "description" => "Heirship Form"],
                ["code" => "16", "title" => "16 - Auction Sales Receipt", "description" => "Auction Sales Receipt"],
                ["code" => "18", "title" => "18 - Storage Lien", "description" => "Storage Lien"],
                ["code" => "19", "title" => "19 - Mechanic's Lien", "description" => "Mechanic's Lien"],
                ["code" => "20", "title" => "20 - Military Registration", "description" => "Military Registration"],
                ["code" => "22", "title" => "22 - Repossession", "description" => "Repossession"],
                ["code" => "23", "title" => "23 - Other", "description" => "Other"],
                ["code" => "24", "title" => "24 - TX Salv Cert of Title", "description" => "TX Salv Cert of Title"],
                ["code" => "25", "title" => "25 - TX Nonrepair Cert of Title", "description" => "TX Nonrepair Cert of Title"],
                ["code" => "26", "title" => "26 - O/S Salv Cert of Title", "description" => "O/S Salv Cert of Title"],
                ["code" => "27", "title" => "27 - O/S Nonrepair Cert of Title", "description" => "O/S Nonrepair Cert of Title"],
                ["code" => "28", "title" => "28 - CCO-TX Salv Cert of Title", "description" => "CCO-TX Salv Cert of Title"],
                ["code" => "29", "title" => "29 - CCO-TX Nonrepair Cert of Title", "description" => "CCO-TX Nonrepair Cert of Title"],
                ["code" => "30", "title" => "30 - FORM VTR 71-5 (Nuisance Abate)", "description" => "FORM VTR 71-5 (Nuisance Abate)"]
            ],
            "LA" => [
                ["code" => "NT", "title" => "NONE - NON Titled"],
                ["code" => "LT", "title" => "Louisiana Title"],
                ["code" => "ST", "title" => "Salvage Title"],
                ["code" => "OST", "title" => "Out-of-State Title"],
                ["code" => "OSSC", "title" => "Out-of-State Salvage Title"],
                ["code" => "GBS", "title" => "Government Bill of Sale"],
                ["code" => "MCO", "title" => "Manufacturer's Cert of Origin"],
                ["code" => "FE", "title" => "Foreign Evidence"],
                ["code" => "CO", "title" => "Court Order"],
                ["code" => "TH", "title" => "Title Hearing"],
                ["code" => "LDSC", "title" => "LA Duplicate Salvage Title"],
                ["code" => "BT", "title" => "Bonded Title"],
                ["code" => "HR", "title" => "Heirship Form"],
                ["code" => "SL", "title" => "Storage Lien"],
                ["code" => "ML", "title" => "MECHANIC'S LIEN"],
                ["code" => "MR", "title" => "MILITARY REGISTRATION"],
                ["code" => "SL", "title" => "REPOSSESSION"],
                ["code" => "OHR", "title" => "OTHER"]
            ]
        ];

        return $ownership[$state];
    }


    public function getSalesTaxExempt($state)
    {
        if (!in_array(strtoupper($state), ["TX", "LA"])) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No data found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No corresponding sales tax exempt for {$state}"
                ]
            ];
        }

        $data = [
            "TX" => [
                ["code" => "CCF", "description" => "Child Care Facility", "slug" => "child_care_facility"],
                ["code" => "CRF", "description" => "Church/Religious Facility", "slug" => "church_religious_facility"],
                ["code" => "DR", "description" => "Dealer Resale", "slug" => "dealer_resale"],
                ["code" => "DT", "description" => "Driver Training", "slug" => "driver_training"],
                ["code" => "FR", "description" => "Farm/Ranch", "slug" => "farm_ranch"],
                ["code" => "FA", "description" => "Fire/Ambulance", "slug" => "fire_ambulance"],
                ["code" => "HS", "description" => "Heirship", "slug" => "heirship"],
                ["code" => "IMC", "description" => "Interstate Motor Carrier", "slug" => "interstate_motor_carrier"],
                ["code" => "MR", "description" => "Minor", "slug" => "minor"],
                ["code" => "NT", "description" => "Nato", "slug" => "nato"],
                ["code" => "OH", "description" => "Orthopedic Handicapped", "slug" => "orthopedic_handicapped"],
                ["code" => "OT", "description" => "Other", "slug" => "other"],
                ["code" => "PA", "description" => "Public Agency", "slug" => "public_agency"],
                ["code" => "RN", "description" => "Rental", "slug" => "rental"],
                ["code" => "SFS", "description" => "Seller-Financed Sale", "slug" => "seller_financed_sale"]
            ],
            "LA" => [
                ["code" => "CU", "description" => "Federal Credit Union", "slug" => "federal_credit_union"],
                ["code" => "FB", "description" => "Federal Land Bank", "slug" => "federal_land_bank"],
                ["code" => "CH", "description" => "Church within Jefferson Parish", "slug" => "church_within_jefferson_parish"],
                ["code" => "PR", "description" => "Prescribed Red Cross", "slug" => "prescribed_red_cross"],
                ["code" => "CS", "description" => "Claims Against Surety", "slug" => "claims_against_surety"],
                ["code" => "DO", "description" => "Donation", "slug" => "donation"],
                ["code" => "ED", "description" => "Donation to School", "slug" => "donation_to_school"],
                ["code" => "FV", "description" => "Farm Vehicle Equipment", "slug" => "farm_vehicle_equipment"],
                ["code" => "FE", "description" => "Farm Use - 3 and 4 Wheelers", "slug" => "farm_use_3_and_4_wheelers"],
                ["code" => "HE", "description" => "Heirship", "slug" => "heirship"],
                ["code" => "SU", "description" => "Succession", "slug" => "succession"],
                ["code" => "IH", "description" => "Interstate Motor Carrier", "slug" => "interstate_motor_carrier"],
                ["code" => "FH", "description" => "For Hire Carrier", "slug" => "for_hire_carrier"],
                ["code" => "HM", "description" => "Homemade Vehicle", "slug" => "homemade_vehicle"],
                ["code" => "DM", "description" => "Demonstrator", "slug" => "demonstrator"],
                ["code" => "IB", "description" => "Independently Owned School Bus", "slug" => "independently_owned_school_bus"],
                ["code" => "EX", "description" => "Public Agency", "slug" => "public_agency"],
                ["code" => "US", "description" => "US Government", "slug" => "us_government"],
                ["code" => "IS", "description" => "Salvage Vehicle", "slug" => "salvage_vehicle"],
                ["code" => "JF", "description" => "Forfeited Vehicle, Judicial LV, Leased Vehicle", "slug" => "forfeited_vehicle_judicial_lv_leased_vehicle"],
                ["code" => "RP", "description" => "Repossession", "slug" => "repossession"],
                ["code" => "SW", "description" => "Sheltered Workshop TP - Taxes Paid", "slug" => "sheltered_workshop_tp_taxes_paid"],
                ["code" => "RT", "description" => "Pari-Mutual Race Tracks", "slug" => "pari_mutual_race_tracks"],
                ["code" => "IC", "description" => "Independent College", "slug" => "independent_college"],
                ["code" => "IT", "description" => "Indian Tribe", "slug" => "indian_tribe"],
                ["code" => "DU", "description" => "Ducks Unlimited", "slug" => "ducks_unlimited"],
                ["code" => "WF", "description" => "Waterfowl and Wetland Habitat Conservation", "slug" => "waterfowl_and_wetland_habitat_conservation"],
                ["code" => "RE", "description" => "Electric Cooperatives", "slug" => "electric_cooperatives"],
                ["code" => "RV", "description" => "Rental Vehicle/Rental Purchase", "slug" => "rental_vehicle_rental_purchase"],
                ["code" => "CP", "description" => "P/M Tax Exemption (Caddo & Calcasieu Parishes)", "slug" => "p_m_tax_exemption_caddo_calcasieu_parishes)"],
                ["code" => "UP", "description" => "Under Protest", "slug" => "under_protest"]
            ]
        ];

        return $data[$state];
    }


    public function getVehicleTypes($state)
    {
        $vehicles = DB::table("state_vehicle_types")
            ->join("states", 'states.code', "=", "state_vehicle_types.state_code")
            ->join("vehicle_types", "vehicle_types.id", "=", "state_vehicle_types.vehicle_type_id")
            ->where("states.code", $state)
            ->select("vehicle_types.name", "vehicle_types.slug", "vehicle_types.class", "vehicle_types.category", "vehicle_types.slug as value")
            ->orderBy("priority")
            ->get();

        if (count($vehicles) == 0) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No data found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No corresponding vehicle types for {$state}"
                ]
            ];
        }

        return $vehicles;
    }


    public function getVehicleColors($state)
    {
        $colors = [
            "TX" => [
                ['code' => "BGE", "description" => "Beige", "slug" => "beige", "hex" => "#f5f5dc"],
                ['code' => "BLK", "description" => "Black", "slug" => "black", "hex" => "#000000"],
                ['code' => "BLU", "description" => "Blue", "slug" => "blue", "hex" => "#0000ff"],
                ['code' => "BRO", "description" => "Brown", "slug" => "brown", "hex" => "#a52a2a"],
                ['code' => "GLD", "description" => "Gold", "slug" => "gold", "hex" => "#ffd700"],
                ['code' => "GRN", "description" => "Green", "slug" => "green", "hex" => "#008000"],
                ['code' => "MAR", "description" => "Maroon", "slug" => "maroon", "hex" => "#800000"],
                ['code' => "ONG", "description" => "Orange", "slug" => "orange", "hex" => "#ffa500"],
                ['code' => "PLE", "description" => "Purple", "slug" => "purple", "hex" => "#551a8b"],
                ['code' => "PNK", "description" => "Pink", "slug" => "pink", "hex" => "#FFC0CB"],
                ['code' => "RED", "description" => "Red", "slug" => "red", "hex" => "#FF0000"],
                ['code' => "SIL", "description" => "Silver", "slug" => "silver", "hex" => "#C0C0C0"],
                ['code' => "TAN", "description" => "Tan", "slug" => "tan", "hex" => "#D2B48C"],
                ['code' => "WHI", "description" => "White", "slug" => "white", "hex" => "#ffffff"],
                ['code' => "YEL", "description" => "Yellow", "slug" => "yellow", "hex" => "#FFFF00"]
            ],
            "LA" => [
                ['code' => "BGE", "description" => "Beige", "slug" => "beige", "hex" => "#f5f5dc"],
                ['code' => "BLK", "description" => "Black", "slug" => "black", "hex" => "#000000"],
                ['code' => "BLU", "description" => "Blue", "slug" => "blue", "hex" => "#0000ff"],
                ['code' => "BRO", "description" => "Brown", "slug" => "brown", "hex" => "#a52a2a"],
                ['code' => "BRZ", "description" => "Bronze", "slug" => "bronze", "hex" => "#cd7f32"],
                ['code' => "COM", "description" => "Chrome", "slug" => "chrome", "hex" => "#E3DEDB"],
                ['code' => "CPR", "description" => "Copper", "slug" => "copper", "hex" => "#C87533"],
                ['code' => "CRM", "description" => "Cream", "slug" => "cream", "hex" => "#f5fffa"],
                ['code' => "DBL", "description" => "Dark Blue", "slug" => "dark_blue", "hex" => "#003366"],
                ['code' => "DGR", "description" => "Dark Green", "slug" => "dark_green", "hex" => "#006400"],
                ['code' => "GLD", "description" => "Gold", "slug" => "gold", "hex" => "#ffd700"],
                ['code' => "GRN", "description" => "Green", "slug" => "green", "hex" => "#008000"],
                ['code' => "LAV", "description" => "Lavendar", "slug" => "lavendar", "hex" => "#E6E6FA"],
                ['code' => "LBL", "description" => "Light Blue", "slug" => "light_blue", "hex" => "#add8e6"],
                ['code' => "LGR", "description" => "Light Green", "slug" => "light_green", "hex" => "#90EE90"],
                ['code' => "MAR", "description" => "Maroon", "slug" => "maroon", "hex" => "#800000"],
                ['code' => "ONG", "description" => "Orange", "slug" => "orange", "hex" => "#ffa500"],
                ['code' => "PLE", "description" => "Purple", "slug" => "purple", "hex" => "#551a8b"],
                ['code' => "PNK", "description" => "Pink", "slug" => "pink", "hex" => "#FFC0CB"],
                ['code' => "RED", "description" => "Red", "slug" => "red", "hex" => "#FF0000"],
                ['code' => "SIL", "description" => "Silver", "slug" => "silver", "hex" => "#C0C0C0"],
                ['code' => "TAN", "description" => "Tan", "slug" => "tan", "hex" => "#D2B48C"],
                ['code' => "TQR", "description" => "Light Turquoise", "slug" => "light_turquoise", "hex" => "#afeeee"],
                ['code' => "TRQ", "description" => "Dark Turquoise", "slug" => "dark_turquoise", "hex" => "#00ced1"],
                ['code' => "WHI", "description" => "White", "slug" => "white", "hex" => "#ffffff"],
                ['code' => "YEL", "description" => "Yellow", "slug" => "yellow", "hex" => "#FFFF00"]
            ]
        ];

        if (!in_array($state, ["TX", "LA"])) {
            return [
                'error' => [
                    'http_code' => 200,
                    'response_msg' => "No data found",
                    'response_code' => "NO_DATA_FOUND",
                    "exception" => "No corresponding colors for {$state}"
                ]
            ];
        }

        return $colors[$state];
    }


    public function getVehicleBodyTypes($state, $vehicle_type)
    {
        $data = [];

        if ($state === "LA") {
            $data = $this->vehicle_service->getLouisianaBodyStyles($vehicle_type);
        }

        if (isset($data['error'])) {
            return $data;
        }

        return $data;
    }

    public function getFuelTypesByState($state)
    {
        return [
            ['code' => "B", "title" => "Bio Diesel", "slug" => "bio_diesel"],
            ['code' => "D", "title" => "Diesel", "slug" => "diesel"],
            ['code' => "F", "title" => "Flex Fuel", "slug" => "flex_fuel"],
            ['code' => "G", "title" => "Gasoline", "slug" => "gasoline"],
            ['code' => "I", "title" => "Plug-in Hybrid", "slug" => "plug_in_hybrid"],
            ['code' => "L", "title" => "Electric", "slug" => "electric"],
            ['code' => "G", "title" => "Natural Gas", "slug" => "natural_gas"],
            ['code' => "P", "title" => "Propane", "slug" => "propane"],
            ['code' => "Y", "title" => "Gas/Electric Hybrid", "slug" => "gas_electric_hybrid"]
        ];
    }

    public function getFormFieldsByTransactionType($state, $transaction_type)
    {
        return [];
    }

    public function getCountiesByState($state)
    {
        return $counties = DB::table("counties")->where("state_code", $state)
            ->select('id', 'state_code', 'code', 'name', 'slug', 'slug as value')
            ->get();
    }
}
