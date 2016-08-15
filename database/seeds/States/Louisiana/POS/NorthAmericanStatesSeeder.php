<?php

namespace Thirty98\Seeder\States\Louisiana\POS;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Thirty98\Models\POSLaNorthAmericanState;
use Thirty98\Models\POSLicenseCode;

class NorthAmericanStatesSeeder extends AbstractDatabaseSeeder
{
    protected function executeSeeder()
    {
        foreach ($this->getNorthAmericanStates() as $north_american_state) {
            $state_code = $north_american_state[0];
            $state_name = $north_american_state[1];
            $state_slug = $this->slugit($state_name);
            $country_code = "US";
            $state_type_code = $north_american_state[2];

            $exists = POSLaNorthAmericanState::where('state_code', '=', $state_code)
                ->where('name', '=', $state_name)
                ->where('slug', '=', $state_slug)
                ->where('country_code', '=', $country_code)
                ->where('state_type_code', '=', $state_type_code)
                ->first();

            if (!$exists) {
                $insert_id = POSLaNorthAmericanState::insertGetId([
                    'state_code' => $state_code,
                    'name' => $state_name,
                    'slug' => $state_slug,
                    'country_code' => $country_code,
                    'state_type_code' => $state_type_code
                ]);

                if (!is_numeric($insert_id)) {
                    die('Insert Failed.');
                }
            }
        }
    }

    protected function getNorthAmericanStates()
    {
        return [
            [
                "FM",
                "Federated States of Micronesia",
                "A"
            ],
            [
                "MH",
                "Marshall Islands",
                "A"
            ],
            [
                "MP",
                "Northern Mariana Islands",
                "A"
            ],
            [
                "PW",
                "Palau",
                "A"
            ],
            [
                "AB",
                "Alberta",
                "C"
            ],
            [
                "BC",
                "British Columbia",
                "C"
            ],
            [
                "MB",
                "Manitoba",
                "C"
            ],
            [
                "NB",
                "New Brunswick",
                "C"
            ],
            [
                "NF",
                "Newfoundland and Labrador",
                "C"
            ],
            [
                "NS",
                "Nova Scotia",
                "C"
            ],
            [
                "NT",
                "Northwest Territory",
                "C"
            ],
            [
                "NU",
                "Nunavut",
                "C"
            ],
            [
                "ON",
                "Ontario",
                "C"
            ],
            [
                "PE",
                "Prince Edward Island",
                "C"
            ],
            [
                "QC",
                "Quebec",
                "C"
            ],
            [
                "SK",
                "Saskatchewan",
                "C"
            ],
            [
                "YT",
                "Yukon Territory",
                "C"
            ],
            [
                "D2",
                "US Dept of Justice",
                "F"
            ],
            [
                "DS",
                "US Dept of State",
                "F"
            ],
            [
                "DT",
                "US Dept of Transportation",
                "F"
            ],
            [
                "FH",
                "Fed Motor Carrier Safety Admin",
                "F"
            ],
            [
                "GS",
                "General Services Admin",
                "F"
            ],
            [
                "IR",
                "Internal Revenue Service",
                "F"
            ],
            [
                "TS",
                "Transportation Security Admin",
                "F"
            ],
            [
                "AA",
                "Armed Forces Americas",
                "M"
            ],
            [
                "AE",
                "Armed Forces AFR/CAN/EUR/ME",
                "M"
            ],
            [
                "AP",
                "Armed Forces Pacific",
                "M"
            ],
            [
                "O",
                "Other",
                "O"
            ],
            [
                "AK",
                "Alaska",
                "S"
            ],
            [
                "AL",
                "Alabama",
                "S"
            ],
            [
                "AR",
                "Arkansas",
                "S"
            ],
            [
                "AZ",
                "Arizona",
                "S"
            ],
            [
                "CA",
                "California",
                "S"
            ],
            [
                "CO",
                "Colorado",
                "S"
            ],
            [
                "CT",
                "Connecticut",
                "S"
            ],
            [
                "DC",
                "District of Columbia",
                "S"
            ],
            [
                "DE",
                "Delaware",
                "S"
            ],
            [
                "FL",
                "Florida",
                "S"
            ],
            [
                "GA",
                "Georgia",
                "S"
            ],
            [
                "HI",
                "Hawaii",
                "S"
            ],
            [
                "IA",
                "Iowa",
                "S"
            ],
            [
                "ID",
                "Idaho",
                "S"
            ],
            [
                "IL",
                "Illinois",
                "S"
            ],
            [
                "IN",
                "Indiana",
                "S"
            ],
            [
                "KS",
                "Kansas",
                "S"
            ],
            [
                "KY",
                "Kentucky",
                "S"
            ],
            [
                "LA",
                "Louisiana",
                "S"
            ],
            [
                "MA",
                "Massachusetts",
                "S"
            ],
            [
                "MD",
                "Maryland",
                "S"
            ],
            [
                "ME",
                "Maine",
                "S"
            ],
            [
                "MI",
                "Michigan",
                "S"
            ],
            [
                "MN",
                "Minnesota",
                "S"
            ],
            [
                "MO",
                "Missouri",
                "S"
            ],
            [
                "MS",
                "Mississippi",
                "S"
            ],
            [
                "MT",
                "Montana",
                "S"
            ],
            [
                "NC",
                "North Carolina",
                "S"
            ],
            [
                "ND",
                "North Dakota",
                "S"
            ],
            [
                "NE",
                "Nebraska",
                "S"
            ],
            [
                "NH",
                "New Hampshire",
                "S"
            ],
            [
                "NJ",
                "New Jersey",
                "S"
            ],
            [
                "NM",
                "New Mexico",
                "S"
            ],
            [
                "NV",
                "Nevada",
                "S"
            ],
            [
                "NY",
                "New York",
                "S"
            ],
            [
                "OH",
                "Ohio",
                "S"
            ],
            [
                "OK",
                "Oklahoma",
                "S"
            ],
            [
                "OR",
                "Oregon",
                "S"
            ],
            [
                "PA",
                "Pennsylvania",
                "S"
            ],
            [
                "RI",
                "Rhode Island",
                "S"
            ],
            [
                "SC",
                "South Carolina",
                "S"
            ],
            [
                "SD",
                "South Dakota",
                "S"
            ],
            [
                "TN",
                "Tennessee",
                "S"
            ],
            [
                "TX",
                "Texas",
                "S"
            ],
            [
                "UT",
                "Utah",
                "S"
            ],
            [
                "VA",
                "Virginia",
                "S"
            ],
            [
                "VT",
                "Vermont",
                "S"
            ],
            [
                "WA",
                "Washington",
                "S"
            ],
            [
                "WI",
                "Wisconsin",
                "S"
            ],
            [
                "WV",
                "West Virginia",
                "S"
            ],
            [
                "WY",
                "Wyoming",
                "S"
            ],
            [
                "AS",
                "American Samoa",
                "T"
            ],
            [
                "GM",
                "Guam",
                "T"
            ],
            [
                "PR",
                "Puerto Rico",
                "T"
            ],
            [
                "VI",
                "Virgin Islands",
                "T"
            ],
            [
                "AG",
                "Aguascalientes",
                "X"
            ],
            [
                "BA",
                "Baja California",
                "X"
            ],
            [
                "BJ",
                "Baja California Sur",
                "X"
            ],
            [
                "CE",
                "Campeche",
                "X"
            ],
            [
                "CH",
                "Chihuahua",
                "X"
            ],
            [
                "CI",
                "Chiapas",
                "X"
            ],
            [
                "CL",
                "Colima",
                "X"
            ],
            [
                "CU",
                "Coahuila de Zaragoza",
                "X"
            ],
            [
                "DF",
                "Distrito Federal Mexico",
                "X"
            ],
            [
                "DO",
                "Durango",
                "X"
            ],
            [
                "EM",
                "Estado de Mexico",
                "X"
            ],
            [
                "GR",
                "Guerrero",
                "X"
            ],
            [
                "GU",
                "Guanajuato",
                "X"
            ],
            [
                "HL",
                "Hidalgo",
                "X"
            ],
            [
                "JL",
                "Jalisco",
                "X"
            ],
            [
                "MC",
                "Michoacan de Ocampo",
                "X"
            ],
            [
                "MR",
                "Morelos",
                "X"
            ],
            [
                "MX",
                "Mexico",
                "X"
            ],
            [
                "NA",
                "Nayarit",
                "X"
            ],
            [
                "NL",
                "Nuevo Leon",
                "X"
            ],
            [
                "OA",
                "Oaxaca",
                "X"
            ],
            [
                "PB",
                "Puebla",
                "X"
            ],
            [
                "QR",
                "Quintana Roo",
                "X"
            ],
            [
                "QU",
                "Queretaro de Arteaga",
                "X"
            ],
            [
                "SI",
                "Sinaloa",
                "X"
            ],
            [
                "SL",
                "San Luis Potosi",
                "X"
            ],
            [
                "SO",
                "Sonora",
                "X"
            ],
            [
                "TA",
                "Tamaulipas",
                "X"
            ],
            [
                "TB",
                "Tabasco",
                "X"
            ],
            [
                "TL",
                "Tlaxcala",
                "X"
            ],
            [
                "VC",
                "Veracruz-Llave",
                "X"
            ],
            [
                "YU",
                "Yucatan",
                "X"
            ],
            [
                "ZA",
                "Zacatecas",
                "X"
            ]
        ];
    }

}
