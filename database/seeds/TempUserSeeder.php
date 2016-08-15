<?php

namespace Thirty98\Seeder;

use Thirty98\API\Stdlib\Seeders\AbstractDatabaseSeeder;
use Thirty98\User;

class TempUserSeeder extends AbstractDatabaseSeeder
{
    /**
     * @return void
     */
    protected function executeSeeder()
    {
        foreach ($this->getUserAccounts() AS $user_account) {
            $exists = User::where('name', '=', $user_account['name'])
                ->where('email', '=', $user_account['email'])
                ->first();

            if (!$exists) {
                User::create($user_account);
            }

            continue;
        }
    }

    private function getUserAccounts()
    {
        return [
            [
                "name" => "hsmith",
                "email" => "hsmith@thirty98.com",
                "password" => "demothirty98"
            ],
            [
                "name" => "BobWhite",
                "email" => "bwhite@latb.com",
                "password" => "bobwhite12345"
            ],
            [
                "name" => "mgomez",
                "email" => "mgomez@machaikford.com",
                "password" => "mary1234"
            ],
            [
                "name" => "rhovind",
                "email" => "rhovind@machaikford.com",
                "password" => "ric12345"
            ],
            [
                "name" => "dplymale",
                "email" => "dplymale@thirty98.com",
                "password" => "debbie1234"
            ],
            [
                "name" => "amehta",
                "email" => "amehta@thirty98.com",
                "password" => "akshaya1234"
            ],
            [
                "name" => "azle740i",
                "email" => "azle740i@aol.com",
                "password" => "bobharvey1234"
            ],
            [
                "name" => "ptallon",
                "email" => "ptallon@thirty98.com",
                "password" => "patrick1234"
            ]
        ];
    }
}
