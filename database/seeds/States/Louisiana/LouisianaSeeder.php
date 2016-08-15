<?php

namespace Thirty98\Seeder\States\Louisiana;

use Thirty98\API\General\Models\Fee;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class LouisianaSeeder extends Seeder
{
    protected $louisiana_entries = [

        ['category' => 'car', 'type' => 'car', 'state' => 'LA', 'fee' => 'TITLE_CORRECTION_FEE', 'amount' => '68.50'],
        ['category' => 'car', 'type' => 'car', 'state' => 'LA', 'fee' => 'TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'car', 'type' => 'car', 'state' => 'LA', 'fee' => 'HANDLING_FEE', 'amount' => '8.00'],
        ['category' => 'car', 'type' => 'car', 'state' => 'LA', 'fee' => 'REG_DUP_FEE', 'amount' => '68.50'],
        ['category' => 'car', 'type' => 'car', 'state' => 'LA', 'fee' => 'LICENSE_TRNSFR_FEE', 'amount' => '3.00'],
        ['category' => 'car', 'type' => 'car', 'state' => 'LA', 'fee' => 'DUP_TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'car', 'type' => 'car', 'state' => 'LA', 'fee' => 'DUP_PLATE_FEE', 'amount' => '10.00'], // SKIP
        ['category' => 'car', 'type' => 'car', 'state' => 'LA', 'fee' => 'PERSNL_PLATE_FEE', 'amount' => '25.00'], // SKIP
        ['category' => 'car', 'type' => 'car', 'state' => 'LA', 'fee' => 'PERSL_PLATE_ADMIN_FEE', 'amount' => '3.50'], // SKIP
        ['category' => 'car', 'type' => 'car', 'state' => 'LA', 'fee' => 'PERSL_PLATE_HANDLING_FEE', 'amount' => '8.00'], // SKIP
        ['category' => 'car', 'type' => 'car', 'state' => 'LA', 'fee' => 'LICENSE_PNLTY_FEE', 'amount' => '3.00'], // SKIP
        ['category' => 'car', 'type' => 'car', 'state' => 'LA', 'fee' => 'LICENSE_DUP_FEE', 'amount' => '12.00'], // SKIP
        ['category' => 'car', 'type' => 'car', 'state' => 'LA', 'fee' => 'NOTARY_FEE', 'amount' => '20.00'],
        ['category' => 'car', 'type' => 'car', 'state' => 'LA', 'fee' => 'CONVENIENCE_FEE', 'amount' => '18.00'],
        ['category' => 'car', 'type' => 'car', 'state' => 'LA', 'fee' => 'PROCESSING_FEE', 'amount' => '37.00'],
        ['category' => 'car', 'type' => 'car', 'state' => 'LA', 'fee' => 'MAIL_FEE', 'amount' => '10.00'],
        ['category' => 'car', 'type' => 'car', 'state' => 'LA', 'fee' => '1-Yr Commercial Plate', 'amount' => '10.00'],
        ['category' => 'car', 'type' => 'car', 'state' => 'LA', 'fee' => '2-Yr Commercial Plate', 'amount' => '20.00'],
        ['category' => 'car', 'type' => 'car', 'state' => 'LA', 'fee' => 'ELECTRONIC_FILING_FEE', 'amount' => '10.00'],

        ['category' => 'van', 'type' => 'van', 'state' => 'LA', 'fee' => 'TITLE_CORRECTION_FEE', 'amount' => '68.50'],
        ['category' => 'van', 'type' => 'van', 'state' => 'LA', 'fee' => 'TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'van', 'type' => 'van', 'state' => 'LA', 'fee' => 'HANDLING_FEE', 'amount' => '8.00'],
        ['category' => 'van', 'type' => 'van', 'state' => 'LA', 'fee' => 'REG_DUP_FEE', 'amount' => '68.50'],
        ['category' => 'van', 'type' => 'van', 'state' => 'LA', 'fee' => 'LICENSE_TRNSFR_FEE', 'amount' => '3.00'],
        ['category' => 'van', 'type' => 'van', 'state' => 'LA', 'fee' => 'DUP_TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'van', 'type' => 'van', 'state' => 'LA', 'fee' => 'DUP_PLATE_FEE', 'amount' => '10.00'],
        ['category' => 'van', 'type' => 'van', 'state' => 'LA', 'fee' => 'PERSNL_PLATE_FEE', 'amount' => '25.00'],
        ['category' => 'van', 'type' => 'van', 'state' => 'LA', 'fee' => 'PERSL_PLATE_ADMIN_FEE', 'amount' => '3.50'],
        ['category' => 'van', 'type' => 'van', 'state' => 'LA', 'fee' => 'PERSL_PLATE_HANDLING_FEE', 'amount' => '8.00'],
        ['category' => 'van', 'type' => 'van', 'state' => 'LA', 'fee' => 'LICENSE_PNLTY_FEE', 'amount' => '3.00'],
        ['category' => 'van', 'type' => 'van', 'state' => 'LA', 'fee' => 'LICENSE_DUP_FEE', 'amount' => '12.00'],
        ['category' => 'van', 'type' => 'van', 'state' => 'LA', 'fee' => 'NOTARY_FEE', 'amount' => '20.00'],
        ['category' => 'van', 'type' => 'van', 'state' => 'LA', 'fee' => 'CONVENIENCE_FEE', 'amount' => '18.00'],
        ['category' => 'van', 'type' => 'van', 'state' => 'LA', 'fee' => 'PROCESSING_FEE', 'amount' => '37.00'],
        ['category' => 'van', 'type' => 'van', 'state' => 'LA', 'fee' => 'MAIL_FEE', 'amount' => '10.00'],
        ['category' => 'van', 'type' => 'van', 'state' => 'LA', 'fee' => '1-Yr Commercial Plate', 'amount' => '10.00'],
        ['category' => 'van', 'type' => 'van', 'state' => 'LA', 'fee' => '2-Yr Commercial Plate', 'amount' => '20.00'],
        ['category' => 'van', 'type' => 'van', 'state' => 'LA', 'fee' => 'ELECTRONIC_FILING_FEE', 'amount' => '10.00'],

        ['category' => 'SUV', 'type' => 'SUV', 'state' => 'LA', 'fee' => 'TITLE_CORRECTION_FEE', 'amount' => '68.50'],
        ['category' => 'SUV', 'type' => 'SUV', 'state' => 'LA', 'fee' => 'TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'SUV', 'type' => 'SUV', 'state' => 'LA', 'fee' => 'HANDLING_FEE', 'amount' => '8.00'],
        ['category' => 'SUV', 'type' => 'SUV', 'state' => 'LA', 'fee' => 'REG_DUP_FEE', 'amount' => '68.50'],
        ['category' => 'SUV', 'type' => 'SUV', 'state' => 'LA', 'fee' => 'LICENSE_TRNSFR_FEE', 'amount' => '3.00'],
        ['category' => 'SUV', 'type' => 'SUV', 'state' => 'LA', 'fee' => 'DUP_TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'SUV', 'type' => 'SUV', 'state' => 'LA', 'fee' => 'DUP_PLATE_FEE', 'amount' => '10.00'],
        ['category' => 'SUV', 'type' => 'SUV', 'state' => 'LA', 'fee' => 'PERSNL_PLATE_FEE', 'amount' => '25.00'],
        ['category' => 'SUV', 'type' => 'SUV', 'state' => 'LA', 'fee' => 'PERSL_PLATE_ADMIN_FEE', 'amount' => '3.50'],
        ['category' => 'SUV', 'type' => 'SUV', 'state' => 'LA', 'fee' => 'PERSL_PLATE_HANDLING_FEE', 'amount' => '8.00'],
        ['category' => 'SUV', 'type' => 'SUV', 'state' => 'LA', 'fee' => 'LICENSE_PNLTY_FEE', 'amount' => '3.00'],
        ['category' => 'SUV', 'type' => 'SUV', 'state' => 'LA', 'fee' => 'LICENSE_DUP_FEE', 'amount' => '12.00'],
        ['category' => 'SUV', 'type' => 'SUV', 'state' => 'LA', 'fee' => 'NOTARY_FEE', 'amount' => '20.00'],
        ['category' => 'SUV', 'type' => 'SUV', 'state' => 'LA', 'fee' => 'CONVENIENCE_FEE', 'amount' => '18.00'],
        ['category' => 'SUV', 'type' => 'SUV', 'state' => 'LA', 'fee' => 'PROCESSING_FEE', 'amount' => '37.00'],
        ['category' => 'SUV', 'type' => 'SUV', 'state' => 'LA', 'fee' => 'MAIL_FEE', 'amount' => '10.00'],
        ['category' => 'SUV', 'type' => 'SUV', 'state' => 'LA', 'fee' => '1-Yr Commercial Plate', 'amount' => '10.00'],
        ['category' => 'SUV', 'type' => 'SUV', 'state' => 'LA', 'fee' => '2-Yr Commercial Plate', 'amount' => '20.00'],
        ['category' => 'SUV', 'type' => 'SUV', 'state' => 'LA', 'fee' => 'ELECTRONIC_FILING_FEE', 'amount' => '10.00'],

        ['category' => 'trailer', 'type' => 'trailer-1y license', 'state' => 'LA', 'fee' => 'TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'trailer', 'type' => 'trailer-1y license', 'state' => 'LA', 'fee' => 'NOTARY_FEE', 'amount' => '20.00'],
        ['category' => 'trailer', 'type' => 'trailer-1y license', 'state' => 'LA', 'fee' => 'CONVENIENCE_FEE', 'amount' => '18.00'],
        ['category' => 'trailer', 'type' => 'trailer-1y license', 'state' => 'LA', 'fee' => 'PROCESSING_FEE', 'amount' => '37.00'],
        ['category' => 'trailer', 'type' => 'trailer-1y license', 'state' => 'LA', 'fee' => 'MAIL_FEE', 'amount' => '10.00'],
        ['category' => 'trailer', 'type' => 'trailer-1y license', 'state' => 'LA', 'fee' => 'TITLE_CORRECTION_FEE', 'amount' => '68.50'],
        ['category' => 'trailer', 'type' => 'trailer-1y license', 'state' => 'LA', 'fee' => 'HANDLING_FEE', 'amount' => '8.00'],
        ['category' => 'trailer', 'type' => 'trailer-1y license', 'state' => 'LA', 'fee' => 'DUP_TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'trailer', 'type' => 'trailer-1y license', 'state' => 'LA', 'fee' => 'LICENSE_DUP_FEE', 'amount' => '12.00'],
        ['category' => 'trailer', 'type' => 'trailer-1y license', 'state' => 'LA', 'fee' => 'LICENSE_PNLTY_FEE', 'amount' => '3.00'],
        ['category' => 'trailer', 'type' => 'trailer-1y license', 'state' => 'LA', 'fee' => 'LICENSE_TRNSFR_FEE', 'amount' => '3.00'],
        ['category' => 'trailer', 'type' => 'trailer-1y license', 'state' => 'LA', 'fee' => 'DUP_PLATE_FEE', 'amount' => '10.00'],
        ['category' => 'trailer', 'type' => 'trailer-1y license', 'state' => 'LA', 'fee' => 'ELECTRONIC_FILING_FEE', 'amount' => '10.00'],

        ['category' => 'trailer', 'type' => 'trailer-4y license', 'state' => 'LA', 'fee' => 'TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'trailer', 'type' => 'trailer-4y license', 'state' => 'LA', 'fee' => 'NOTARY_FEE', 'amount' => '20.00'],
        ['category' => 'trailer', 'type' => 'trailer-4y license', 'state' => 'LA', 'fee' => 'CONVENIENCE_FEE', 'amount' => '18.00'],
        ['category' => 'trailer', 'type' => 'trailer-4y license', 'state' => 'LA', 'fee' => 'PROCESSING_FEE', 'amount' => '37.00'],
        ['category' => 'trailer', 'type' => 'trailer-4y license', 'state' => 'LA', 'fee' => 'MAIL_FEE', 'amount' => '10.00'],
        ['category' => 'trailer', 'type' => 'trailer-4y license', 'state' => 'LA', 'fee' => 'TITLE_CORRECTION_FEE', 'amount' => '68.50'],
        ['category' => 'trailer', 'type' => 'trailer-4y license', 'state' => 'LA', 'fee' => 'HANDLING_FEE', 'amount' => '8.00'],
        ['category' => 'trailer', 'type' => 'trailer-4y license', 'state' => 'LA', 'fee' => 'DUP_TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'trailer', 'type' => 'trailer-4y license', 'state' => 'LA', 'fee' => 'LICENSE_DUP_FEE', 'amount' => '12.00'],
        ['category' => 'trailer', 'type' => 'trailer-4y license', 'state' => 'LA', 'fee' => 'LICENSE_PNLTY_FEE', 'amount' => '3.00'],
        ['category' => 'trailer', 'type' => 'trailer-4y license', 'state' => 'LA', 'fee' => 'LICENSE_TRNSFR_FEE', 'amount' => '3.00'],
        ['category' => 'trailer', 'type' => 'trailer-4y license', 'state' => 'LA', 'fee' => 'DUP_PLATE_FEE', 'amount' => '10.00'],
        ['category' => 'trailer', 'type' => 'trailer-4y license', 'state' => 'LA', 'fee' => 'ELECTRONIC_FILING_FEE', 'amount' => '10.00'],

        ['category' => 'trailer', 'type' => 'semi-trailer', 'state' => 'LA', 'fee' => 'TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'trailer', 'type' => 'semi-trailer', 'state' => 'LA', 'fee' => 'NOTARY_FEE', 'amount' => '20.00'],
        ['category' => 'trailer', 'type' => 'semi-trailer', 'state' => 'LA', 'fee' => 'CONVENIENCE_FEE', 'amount' => '18.00'],
        ['category' => 'trailer', 'type' => 'semi-trailer', 'state' => 'LA', 'fee' => 'PROCESSING_FEE', 'amount' => '37.00'],
        ['category' => 'trailer', 'type' => 'semi-trailer', 'state' => 'LA', 'fee' => 'MAIL_FEE', 'amount' => '10.00'],
        ['category' => 'trailer', 'type' => 'semi-trailer', 'state' => 'LA', 'fee' => 'TITLE_CORRECTION_FEE', 'amount' => '68.50'],
        ['category' => 'trailer', 'type' => 'semi-trailer', 'state' => 'LA', 'fee' => 'HANDLING_FEE', 'amount' => '8.00'],
        ['category' => 'trailer', 'type' => 'semi-trailer', 'state' => 'LA', 'fee' => 'DUP_TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'trailer', 'type' => 'semi-trailer', 'state' => 'LA', 'fee' => 'LICENSE_DUP_FEE', 'amount' => '12.00'],
        ['category' => 'trailer', 'type' => 'semi-trailer', 'state' => 'LA', 'fee' => 'LICENSE_PNLTY_FEE', 'amount' => '3.00'],
        ['category' => 'trailer', 'type' => 'semi-trailer', 'state' => 'LA', 'fee' => 'LICENSE_TRNSFR_FEE', 'amount' => '3.00'],
        ['category' => 'trailer', 'type' => 'semi-trailer', 'state' => 'LA', 'fee' => 'DUP_PLATE_FEE', 'amount' => '10.00'],
        ['category' => 'trailer', 'type' => 'semi-trailer', 'state' => 'LA', 'fee' => 'ELECTRONIC_FILING_FEE', 'amount' => '10.00'],

        ['category' => 'truck-tractor', 'type' => 'truck-tractor', 'state' => 'LA', 'fee' => 'TITLE_CORRECTION_FEE', 'amount' => '68.50'],
        ['category' => 'truck-tractor', 'type' => 'truck-tractor', 'state' => 'LA', 'fee' => 'TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'truck-tractor', 'type' => 'truck-tractor', 'state' => 'LA', 'fee' => 'HANDLING_FEE', 'amount' => '8.00'],
        ['category' => 'truck-tractor', 'type' => 'truck-tractor', 'state' => 'LA', 'fee' => 'REG_DUP_FEE', 'amount' => '68.50'],
        ['category' => 'truck-tractor', 'type' => 'truck-tractor', 'state' => 'LA', 'fee' => 'LICENSE_TRNSFR_FEE', 'amount' => '3.00'],
        ['category' => 'truck-tractor', 'type' => 'truck-tractor', 'state' => 'LA', 'fee' => 'DUP_TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'truck-tractor', 'type' => 'truck-tractor', 'state' => 'LA', 'fee' => 'DUP_PLATE_FEE', 'amount' => '10.00'],
        ['category' => 'truck-tractor', 'type' => 'truck-tractor', 'state' => 'LA', 'fee' => 'LICENSE_PNLTY_FEE', 'amount' => '3.00'],
        ['category' => 'truck-tractor', 'type' => 'truck-tractor', 'state' => 'LA', 'fee' => 'LICENSE_DUP_FEE', 'amount' => '12.00'],
        ['category' => 'truck-tractor', 'type' => 'truck-tractor', 'state' => 'LA', 'fee' => 'NOTARY_FEE', 'amount' => '20.00'],
        ['category' => 'truck-tractor', 'type' => 'truck-tractor', 'state' => 'LA', 'fee' => 'CONVENIENCE_FEE', 'amount' => '18.00'],
        ['category' => 'truck-tractor', 'type' => 'truck-tractor', 'state' => 'LA', 'fee' => 'PROCESSING_FEE', 'amount' => '37.00'],
        ['category' => 'truck-tractor', 'type' => 'truck-tractor', 'state' => 'LA', 'fee' => 'MAIL_FEE', 'amount' => '10.00'],
        ['category' => 'truck-tractor', 'type' => 'truck-tractor', 'state' => 'LA', 'fee' => 'ELECTRONIC_FILING_FEE', 'amount' => '10.00'],

        ['category' => 'bus', 'type' => 'private-bus', 'state' => 'LA', 'fee' => 'TITLE_CORRECTION_FEE', 'amount' => '68.50'],
        ['category' => 'bus', 'type' => 'private-bus', 'state' => 'LA', 'fee' => 'TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'bus', 'type' => 'private-bus', 'state' => 'LA', 'fee' => 'HANDLING_FEE', 'amount' => '8.00'],
        ['category' => 'bus', 'type' => 'private-bus', 'state' => 'LA', 'fee' => 'REG_DUP_FEE', 'amount' => '68.50'],
        ['category' => 'bus', 'type' => 'private-bus', 'state' => 'LA', 'fee' => 'LICENSE_TRNSFR_FEE', 'amount' => '3.00'],
        ['category' => 'bus', 'type' => 'private-bus', 'state' => 'LA', 'fee' => 'DUP_TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'bus', 'type' => 'private-bus', 'state' => 'LA', 'fee' => 'DUP_PLATE_FEE', 'amount' => '10.00'],
        ['category' => 'bus', 'type' => 'private-bus', 'state' => 'LA', 'fee' => 'LICENSE_PNLTY_FEE', 'amount' => '3.00'],
        ['category' => 'bus', 'type' => 'private-bus', 'state' => 'LA', 'fee' => 'LICENSE_DUP_FEE', 'amount' => '12.00'],
        ['category' => 'bus', 'type' => 'private-bus', 'state' => 'LA', 'fee' => 'NOTARY_FEE', 'amount' => '20.00'],
        ['category' => 'bus', 'type' => 'private-bus', 'state' => 'LA', 'fee' => 'CONVENIENCE_FEE', 'amount' => '18.00'],
        ['category' => 'bus', 'type' => 'private-bus', 'state' => 'LA', 'fee' => 'PROCESSING_FEE', 'amount' => '37.00'],
        ['category' => 'bus', 'type' => 'private-bus', 'state' => 'LA', 'fee' => 'MAIL_FEE', 'amount' => '10.00'],
        ['category' => 'bus', 'type' => 'private-bus', 'state' => 'LA', 'fee' => 'LICENSE_FEE', 'amount' => '25.00'],
        ['category' => 'bus', 'type' => 'private-bus', 'state' => 'LA', 'fee' => 'ELECTRONIC_FILING_FEE', 'amount' => '10.00'],

        ['category' => 'off-road', 'type' => 'off-road-vehicle', 'state' => 'LA', 'fee' => 'TITLE_CORRECTION_FEE', 'amount' => '68.50'],
        ['category' => 'off-road', 'type' => 'off-road-vehicle', 'state' => 'LA', 'fee' => 'TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'off-road', 'type' => 'off-road-vehicle', 'state' => 'LA', 'fee' => 'HANDLING_FEE', 'amount' => '8.00'],
        ['category' => 'off-road', 'type' => 'off-road-vehicle', 'state' => 'LA', 'fee' => 'REG_DUP_FEE', 'amount' => '68.50'],
        ['category' => 'off-road', 'type' => 'off-road-vehicle', 'state' => 'LA', 'fee' => 'LICENSE_TRNSFR_FEE', 'amount' => '3.00'],
        ['category' => 'off-road', 'type' => 'off-road-vehicle', 'state' => 'LA', 'fee' => 'DUP_TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'off-road', 'type' => 'off-road-vehicle', 'state' => 'LA', 'fee' => 'DUP_PLATE_FEE', 'amount' => '10.00'],
        ['category' => 'off-road', 'type' => 'off-road-vehicle', 'state' => 'LA', 'fee' => 'LICENSE_PNLTY_FEE', 'amount' => '3.00'],
        ['category' => 'off-road', 'type' => 'off-road-vehicle', 'state' => 'LA', 'fee' => 'LICENSE_DUP_FEE', 'amount' => '12.00'],
        ['category' => 'off-road', 'type' => 'off-road-vehicle', 'state' => 'LA', 'fee' => 'NOTARY_FEE', 'amount' => '20.00'],
        ['category' => 'off-road', 'type' => 'off-road-vehicle', 'state' => 'LA', 'fee' => 'CONVENIENCE_FEE', 'amount' => '18.00'],
        ['category' => 'off-road', 'type' => 'off-road-vehicle', 'state' => 'LA', 'fee' => 'PROCESSING_FEE', 'amount' => '37.00'],
        ['category' => 'off-road', 'type' => 'off-road-vehicle', 'state' => 'LA', 'fee' => 'MAIL_FEE', 'amount' => '10.00'],
        ['category' => 'off-road', 'type' => 'off-road-vehicle', 'state' => 'LA', 'fee' => 'LICENSE_FEE', 'amount' => '12.00'],
        ['category' => 'off-road', 'type' => 'off-road-vehicle', 'state' => 'LA', 'fee' => 'ELECTRONIC_FILING_FEE', 'amount' => '10.00'],

        ['category' => 'collector-vehicle', 'type' => 'collector-vehicle', 'state' => 'LA', 'fee' => 'TITLE_CORRECTION_FEE', 'amount' => '68.50'],
        ['category' => 'collector-vehicle', 'type' => 'collector-vehicle', 'state' => 'LA', 'fee' => 'TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'collector-vehicle', 'type' => 'collector-vehicle', 'state' => 'LA', 'fee' => 'HANDLING_FEE', 'amount' => '8.00'],
        ['category' => 'collector-vehicle', 'type' => 'collector-vehicle', 'state' => 'LA', 'fee' => 'REG_DUP_FEE', 'amount' => '68.50'],
        ['category' => 'collector-vehicle', 'type' => 'collector-vehicle', 'state' => 'LA', 'fee' => 'LICENSE_TRNSFR_FEE', 'amount' => '3.00'],
        ['category' => 'collector-vehicle', 'type' => 'collector-vehicle', 'state' => 'LA', 'fee' => 'DUP_TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'collector-vehicle', 'type' => 'collector-vehicle', 'state' => 'LA', 'fee' => 'DUP_PLATE_FEE', 'amount' => '10.00'],
        ['category' => 'collector-vehicle', 'type' => 'collector-vehicle', 'state' => 'LA', 'fee' => 'LICENSE_PNLTY_FEE', 'amount' => '3.00'],
        ['category' => 'collector-vehicle', 'type' => 'collector-vehicle', 'state' => 'LA', 'fee' => 'LICENSE_DUP_FEE', 'amount' => '12.00'],
        ['category' => 'collector-vehicle', 'type' => 'collector-vehicle', 'state' => 'LA', 'fee' => 'NOTARY_FEE', 'amount' => '20.00'],
        ['category' => 'collector-vehicle', 'type' => 'collector-vehicle', 'state' => 'LA', 'fee' => 'CONVENIENCE_FEE', 'amount' => '18.00'],
        ['category' => 'collector-vehicle', 'type' => 'collector-vehicle', 'state' => 'LA', 'fee' => 'PROCESSING_FEE', 'amount' => '37.00'],
        ['category' => 'collector-vehicle', 'type' => 'collector-vehicle', 'state' => 'LA', 'fee' => 'MAIL_FEE', 'amount' => '10.00'],
        ['category' => 'collector-vehicle', 'type' => 'collector-vehicle', 'state' => 'LA', 'fee' => 'LICENSE_FEE', 'amount' => '25.00'],
        ['category' => 'collector-vehicle', 'type' => 'collector-vehicle', 'state' => 'LA', 'fee' => 'ELECTRONIC_FILING_FEE', 'amount' => '10.00'],

        ['category' => 'truck', 'type' => 'truck', 'state' => 'LA', 'fee' => 'TITLE_CORRECTION_FEE', 'amount' => '68.50'],
        ['category' => 'truck', 'type' => 'truck', 'state' => 'LA', 'fee' => 'TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'truck', 'type' => 'truck', 'state' => 'LA', 'fee' => 'HANDLING_FEE', 'amount' => '8.00'],
        ['category' => 'truck', 'type' => 'truck', 'state' => 'LA', 'fee' => 'REG_DUP_FEE', 'amount' => '68.50'],
        ['category' => 'truck', 'type' => 'truck', 'state' => 'LA', 'fee' => 'LICENSE_TRNSFR_FEE', 'amount' => '3.00'],
        ['category' => 'truck', 'type' => 'truck', 'state' => 'LA', 'fee' => 'DUP_TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'truck', 'type' => 'truck', 'state' => 'LA', 'fee' => 'DUP_PLATE_FEE', 'amount' => '10.00'],
        ['category' => 'truck', 'type' => 'truck', 'state' => 'LA', 'fee' => 'LICENSE_PNLTY_FEE', 'amount' => '3.00'],
        ['category' => 'truck', 'type' => 'truck', 'state' => 'LA', 'fee' => 'LICENSE_DUP_FEE', 'amount' => '12.00'],
        ['category' => 'truck', 'type' => 'truck', 'state' => 'LA', 'fee' => 'NOTARY_FEE', 'amount' => '20.00'],
        ['category' => 'truck', 'type' => 'truck', 'state' => 'LA', 'fee' => 'CONVENIENCE_FEE', 'amount' => '18.00'],
        ['category' => 'truck', 'type' => 'truck', 'state' => 'LA', 'fee' => 'PROCESSING_FEE', 'amount' => '37.00'],
        ['category' => 'truck', 'type' => 'truck', 'state' => 'LA', 'fee' => 'MAIL_FEE', 'amount' => '10.00'],
        ['category' => 'truck', 'type' => 'truck', 'state' => 'LA', 'fee' => 'ELECTRONIC_FILING_FEE', 'amount' => '10.00'],

        ['category' => 'commercial', 'type' => 'commercial', 'state' => 'LA', 'fee' => 'TITLE_CORRECTION_FEE', 'amount' => '68.50'],
        ['category' => 'commercial', 'type' => 'commercial', 'state' => 'LA', 'fee' => 'TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'commercial', 'type' => 'commercial', 'state' => 'LA', 'fee' => 'HANDLING_FEE', 'amount' => '8.00'],
        ['category' => 'commercial', 'type' => 'commercial', 'state' => 'LA', 'fee' => 'REG_DUP_FEE', 'amount' => '68.50'],
        ['category' => 'commercial', 'type' => 'commercial', 'state' => 'LA', 'fee' => 'LICENSE_TRNSFR_FEE', 'amount' => '3.00'],
        ['category' => 'commercial', 'type' => 'commercial', 'state' => 'LA', 'fee' => 'DUP_TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'commercial', 'type' => 'commercial', 'state' => 'LA', 'fee' => 'DUP_PLATE_FEE', 'amount' => '10.00'],
        ['category' => 'commercial', 'type' => 'commercial', 'state' => 'LA', 'fee' => 'LICENSE_PNLTY_FEE', 'amount' => '3.00'],
        ['category' => 'commercial', 'type' => 'commercial', 'state' => 'LA', 'fee' => 'LICENSE_DUP_FEE', 'amount' => '12.00'],
        ['category' => 'commercial', 'type' => 'commercial', 'state' => 'LA', 'fee' => 'NOTARY_FEE', 'amount' => '20.00'],
        ['category' => 'commercial', 'type' => 'commercial', 'state' => 'LA', 'fee' => 'CONVENIENCE_FEE', 'amount' => '18.00'],
        ['category' => 'commercial', 'type' => 'commercial', 'state' => 'LA', 'fee' => 'PROCESSING_FEE', 'amount' => '37.00'],
        ['category' => 'commercial', 'type' => 'commercial', 'state' => 'LA', 'fee' => 'MAIL_FEE', 'amount' => '10.00'],
        ['category' => 'commercial', 'type' => 'commercial', 'state' => 'LA', 'fee' => 'ELECTRONIC_FILING_FEE', 'amount' => '10.00'],

        ['category' => 'recreational', 'type' => 'motor-home', 'state' => 'LA', 'fee' => 'TITLE_CORRECTION_FEE', 'amount' => '68.50'],
        ['category' => 'recreational', 'type' => 'motor-home', 'state' => 'LA', 'fee' => 'TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'recreational', 'type' => 'motor-home', 'state' => 'LA', 'fee' => 'HANDLING_FEE', 'amount' => '8.00'],
        ['category' => 'recreational', 'type' => 'motor-home', 'state' => 'LA', 'fee' => 'REG_DUP_FEE', 'amount' => '68.50'],
        ['category' => 'recreational', 'type' => 'motor-home', 'state' => 'LA', 'fee' => 'LICENSE_TRNSFR_FEE', 'amount' => '3.00'],
        ['category' => 'recreational', 'type' => 'motor-home', 'state' => 'LA', 'fee' => 'DUP_TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'recreational', 'type' => 'motor-home', 'state' => 'LA', 'fee' => 'DUP_PLATE_FEE', 'amount' => '10.00'],
        ['category' => 'recreational', 'type' => 'motor-home', 'state' => 'LA', 'fee' => 'LICENSE_PNLTY_FEE', 'amount' => '3.00'],
        ['category' => 'recreational', 'type' => 'motor-home', 'state' => 'LA', 'fee' => 'LICENSE_DUP_FEE', 'amount' => '12.00'],
        ['category' => 'recreational', 'type' => 'motor-home', 'state' => 'LA', 'fee' => 'NOTARY_FEE', 'amount' => '20.00'],
        ['category' => 'recreational', 'type' => 'motor-home', 'state' => 'LA', 'fee' => 'CONVENIENCE_FEE', 'amount' => '18.00'],
        ['category' => 'recreational', 'type' => 'motor-home', 'state' => 'LA', 'fee' => 'PROCESSING_FEE', 'amount' => '37.00'],
        ['category' => 'recreational', 'type' => 'motor-home', 'state' => 'LA', 'fee' => 'MAIL_FEE', 'amount' => '10.00'],
        ['category' => 'recreational', 'type' => 'motor-home', 'state' => 'LA', 'fee' => 'ELECTRONIC_FILING_FEE', 'amount' => '10.00'],

        ['category' => 'motorcycle', 'type' => 'motorcycle', 'state' => 'LA', 'fee' => 'TITLE_CORRECTION_FEE', 'amount' => '68.50'],
        ['category' => 'motorcycle', 'type' => 'motorcycle', 'state' => 'LA', 'fee' => 'TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'motorcycle', 'type' => 'motorcycle', 'state' => 'LA', 'fee' => 'HANDLING_FEE', 'amount' => '8.00'],
        ['category' => 'motorcycle', 'type' => 'motorcycle', 'state' => 'LA', 'fee' => 'REG_DUP_FEE', 'amount' => '68.50'],
        ['category' => 'motorcycle', 'type' => 'motorcycle', 'state' => 'LA', 'fee' => 'LICENSE_TRNSFR_FEE', 'amount' => '3.00'],
        ['category' => 'motorcycle', 'type' => 'motorcycle', 'state' => 'LA', 'fee' => 'DUP_TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'motorcycle', 'type' => 'motorcycle', 'state' => 'LA', 'fee' => 'DUP_PLATE_FEE', 'amount' => '10.00'],
        ['category' => 'motorcycle', 'type' => 'motorcycle', 'state' => 'LA', 'fee' => 'PERSNL_PLATE_FEE', 'amount' => '25.00'],
        ['category' => 'motorcycle', 'type' => 'motorcycle', 'state' => 'LA', 'fee' => 'PERSL_PLATE_ADMIN_FEE', 'amount' => '3.50'],
        ['category' => 'motorcycle', 'type' => 'motorcycle', 'state' => 'LA', 'fee' => 'PERSL_PLATE_HANDLING_FEE', 'amount' => '8.00'],
        ['category' => 'motorcycle', 'type' => 'motorcycle', 'state' => 'LA', 'fee' => 'LICENSE_PNLTY_FEE', 'amount' => '3.00'],
        ['category' => 'motorcycle', 'type' => 'motorcycle', 'state' => 'LA', 'fee' => 'LICENSE_DUP_FEE', 'amount' => '12.00'],
        ['category' => 'motorcycle', 'type' => 'motorcycle', 'state' => 'LA', 'fee' => 'NOTARY_FEE', 'amount' => '20.00'],
        ['category' => 'motorcycle', 'type' => 'motorcycle', 'state' => 'LA', 'fee' => 'CONVENIENCE_FEE', 'amount' => '18.00'],
        ['category' => 'motorcycle', 'type' => 'motorcycle', 'state' => 'LA', 'fee' => 'PROCESSING_FEE', 'amount' => '37.00'],
        ['category' => 'motorcycle', 'type' => 'motorcycle', 'state' => 'LA', 'fee' => 'MAIL_FEE', 'amount' => '10.00'],
        ['category' => 'motorcycle', 'type' => 'motorcycle', 'state' => 'LA', 'fee' => 'ELECTRONIC_FILING_FEE', 'amount' => '10.00'],

        ['category' => 'trailer', 'type' => 'trailer', 'state' => 'LA', 'fee' => 'TITLE_CORRECTION_FEE', 'amount' => '68.50'],
        ['category' => 'trailer', 'type' => 'trailer', 'state' => 'LA', 'fee' => 'TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'trailer', 'type' => 'trailer', 'state' => 'LA', 'fee' => 'HANDLING_FEE', 'amount' => '8.00'],
        ['category' => 'trailer', 'type' => 'trailer', 'state' => 'LA', 'fee' => 'REG_DUP_FEE', 'amount' => '68.50'],
        ['category' => 'trailer', 'type' => 'trailer', 'state' => 'LA', 'fee' => 'LICENSE_TRNSFR_FEE', 'amount' => '3.00'],
        ['category' => 'trailer', 'type' => 'trailer', 'state' => 'LA', 'fee' => 'DUP_TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'trailer', 'type' => 'trailer', 'state' => 'LA', 'fee' => 'DUP_PLATE_FEE', 'amount' => '10.00'],
        ['category' => 'trailer', 'type' => 'trailer', 'state' => 'LA', 'fee' => 'LICENSE_PNLTY_FEE', 'amount' => '3.00'],
        ['category' => 'trailer', 'type' => 'trailer', 'state' => 'LA', 'fee' => 'LICENSE_DUP_FEE', 'amount' => '12.00'],
        ['category' => 'trailer', 'type' => 'trailer', 'state' => 'LA', 'fee' => 'NOTARY_FEE', 'amount' => '20.00'],
        ['category' => 'trailer', 'type' => 'trailer', 'state' => 'LA', 'fee' => 'CONVENIENCE_FEE', 'amount' => '18.00'],
        ['category' => 'trailer', 'type' => 'trailer', 'state' => 'LA', 'fee' => 'PROCESSING_FEE', 'amount' => '37.00'],
        ['category' => 'trailer', 'type' => 'trailer', 'state' => 'LA', 'fee' => 'MAIL_FEE', 'amount' => '10.00'],
        ['category' => 'trailer', 'type' => 'trailer', 'state' => 'LA', 'fee' => 'ELECTRONIC_FILING_FEE', 'amount' => '10.00'],

        ['category' => 'trailer', 'type' => 'utility-trailer', 'state' => 'LA', 'fee' => 'TITLE_CORRECTION_FEE', 'amount' => '68.50'],
        ['category' => 'trailer', 'type' => 'utility-trailer', 'state' => 'LA', 'fee' => 'TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'trailer', 'type' => 'utility-trailer', 'state' => 'LA', 'fee' => 'HANDLING_FEE', 'amount' => '8.00'],
        ['category' => 'trailer', 'type' => 'utility-trailer', 'state' => 'LA', 'fee' => 'REG_DUP_FEE', 'amount' => '68.50'],
        ['category' => 'trailer', 'type' => 'utility-trailer', 'state' => 'LA', 'fee' => 'LICENSE_TRNSFR_FEE', 'amount' => '3.00'],
        ['category' => 'trailer', 'type' => 'utility-trailer', 'state' => 'LA', 'fee' => 'DUP_TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'trailer', 'type' => 'utility-trailer', 'state' => 'LA', 'fee' => 'DUP_PLATE_FEE', 'amount' => '10.00'],
        ['category' => 'trailer', 'type' => 'utility-trailer', 'state' => 'LA', 'fee' => 'LICENSE_PNLTY_FEE', 'amount' => '3.00'],
        ['category' => 'trailer', 'type' => 'utility-trailer', 'state' => 'LA', 'fee' => 'LICENSE_DUP_FEE', 'amount' => '12.00'],
        ['category' => 'trailer', 'type' => 'utility-trailer', 'state' => 'LA', 'fee' => 'NOTARY_FEE', 'amount' => '20.00'],
        ['category' => 'trailer', 'type' => 'utility-trailer', 'state' => 'LA', 'fee' => 'CONVENIENCE_FEE', 'amount' => '18.00'],
        ['category' => 'trailer', 'type' => 'utility-trailer', 'state' => 'LA', 'fee' => 'PROCESSING_FEE', 'amount' => '37.00'],
        ['category' => 'trailer', 'type' => 'utility-trailer', 'state' => 'LA', 'fee' => 'MAIL_FEE', 'amount' => '10.00'],
        ['category' => 'trailer', 'type' => 'utility-trailer', 'state' => 'LA', 'fee' => 'ELECTRONIC_FILING_FEE', 'amount' => '10.00'],

        ['category' => 'trailer', 'type' => 'boat-trailer', 'state' => 'LA', 'fee' => 'TITLE_CORRECTION_FEE', 'amount' => '68.50'],
        ['category' => 'trailer', 'type' => 'boat-trailer', 'state' => 'LA', 'fee' => 'TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'trailer', 'type' => 'boat-trailer', 'state' => 'LA', 'fee' => 'HANDLING_FEE', 'amount' => '8.00'],
        ['category' => 'trailer', 'type' => 'boat-trailer', 'state' => 'LA', 'fee' => 'REG_DUP_FEE', 'amount' => '68.50'],
        ['category' => 'trailer', 'type' => 'boat-trailer', 'state' => 'LA', 'fee' => 'LICENSE_TRNSFR_FEE', 'amount' => '3.00'],
        ['category' => 'trailer', 'type' => 'boat-trailer', 'state' => 'LA', 'fee' => 'DUP_TITLE_FEE', 'amount' => '68.50'],
        ['category' => 'trailer', 'type' => 'boat-trailer', 'state' => 'LA', 'fee' => 'DUP_PLATE_FEE', 'amount' => '10.00'],
        ['category' => 'trailer', 'type' => 'boat-trailer', 'state' => 'LA', 'fee' => 'LICENSE_PNLTY_FEE', 'amount' => '3.00'],
        ['category' => 'trailer', 'type' => 'boat-trailer', 'state' => 'LA', 'fee' => 'LICENSE_DUP_FEE', 'amount' => '12.00'],
        ['category' => 'trailer', 'type' => 'boat-trailer', 'state' => 'LA', 'fee' => 'NOTARY_FEE', 'amount' => '20.00'],
        ['category' => 'trailer', 'type' => 'boat-trailer', 'state' => 'LA', 'fee' => 'CONVENIENCE_FEE', 'amount' => '18.00'],
        ['category' => 'trailer', 'type' => 'boat-trailer', 'state' => 'LA', 'fee' => 'PROCESSING_FEE', 'amount' => '37.00'],
        ['category' => 'trailer', 'type' => 'boat-trailer', 'state' => 'LA', 'fee' => 'MAIL_FEE', 'amount' => '10.00'],
        ['category' => 'trailer', 'type' => 'boat-trailer', 'state' => 'LA', 'fee' => 'ELECTRONIC_FILING_FEE', 'amount' => '10.00'],
    ];

    protected $county_parishes = [
        [
            'parish' => 'ACADIA',
            'cities' => ['Crowley', 'Churchpoint', 'Estherwood', 'Iota', 'Morse',
                'Rayne', 'Mermentau', 'Eunice', 'City Of Basile', 'City Of Duson'],
            ''
        ],
        [
            'parish' => 'ALLEN',
            'cities' => ['Oakdale', 'Oberlin', 'Elizabeth', 'Kinder', 'Village Of Reeves']
        ],
        [
            'parish' => 'ASCENSION EAST',
            'cities' => ['Gonzales', 'East Ascension (East Bank)', 'Sorrento', 'Gonzales-Tanger Mall Dev Dist']
        ],
        [
            'parish' => 'ASCENSION WEST',
            'cities' => ['Donaldsonville', 'West Ascension Hospital Service (West Bank)']
        ],
        [
            'parish' => 'ASSUMPTION',
            'cities' => ['Napoleonville']
        ],
        [
            'parish' => 'AVOYELLES',
            'cities' => ['Cottonport', 'Bunkie', 'Plaucheville', 'Moreauville', 'Marksville',
                'Simmesport', 'Mansura', 'Hessmer']
        ],
        [
            'parish' => 'BEAUREGARD',
            'cities' => ['Deridder', 'Merryville']
        ],
        [
            'parish' => 'BIENVILLE',
            'cities' => ['Ringgold', 'Town Of Arcadia', 'Gibsland', 'Castor']
        ],
        [
            'parish' => 'BOSSIER',
            'cities' => ['Bossier City', 'Plain Dealing', 'Benton', 'Haughton', 'Shreveport ']
        ],
        [
            'parish' => 'CADDO',
            'cities' => ['Oil City', 'Vivian', 'Shreveport', 'Mooringsport', 'Greenwood', 'Rodessa',
                'Blanchard', 'Village Of Ida', 'N. Caddo Hospital Dist-Parish']
        ],
        [
            'parish' => 'CALCASIEU',
            'cities' => ['Lake Charles', 'Sulphur', 'Iowa', 'Dequincy', 'Westlake',
                'Vinton', 'Sales Tax Dist. 3 Unincorporated Ward #1 Only.', 'Sales Tax District 4A']
        ],
        [
            'parish' => 'CALDWELL',
            'cities' => ['Columbia']
        ],
        [
            'parish' => 'CAMERON',
            'cities' => []
        ],
        [
            'parish' => 'CATAHOULA',
            'cities' => []
        ],
        [
            'parish' => 'CLAIBORNE',
            'cities' => ['Haynesville', 'Homer', 'Junction City']
        ],
        [
            'parish' => 'CONCORDIA',
            'cities' => ['Vidalia', 'Ferriday']
        ],
        [
            'parish' => 'DESOTO',
            'cities' => ['Logansport', 'Mansfield', 'Stonewall', 'South Mansfield', 'Grand Cane', 'Keachi']
        ],
        [
            'parish' => 'EAST BATON ROUGE',
            'cities' => ['Baton Rouge/ Ebrp School District', 'Baker/Baker School District', 'Central/Central School District',
                'Zachary/Zachary School District', 'Zachary School Dist/Ebr Parish', 'City Of Baker/Ebr Parish School Dist',
                'Ebr Parish/Central School Dist']
        ],
        [
            'parish' => 'EAST CARROLL',
            'cities' => ['Lake Providence']
        ],
        [
            'parish' => 'EAST FELICIANA',
            'cities' => ['Lake Providence', 'Clinton']
        ],
        [
            'parish' => 'EVANGENLINE',
            'cities' => ['Ville Platte', 'Basile', 'Mamou', 'Pine Prairie', 'Chataignier',
                'Turkey Creek', 'Rural Evangeline Except Ward 2', 'Rural Evangeline Ward 2 Only']
        ],
        [
            'parish' => 'FRANKLIN',
            'cities' => ['Winnsboro', 'Wisner', 'Gilbert', 'Village Of Baskin']
        ],
        [
            'parish' => 'GRANT',
            'cities' => ['Colfax', 'Pollock', 'Georgetown', 'Creola',
                'Montgomery', 'Dry Prong']
        ],
        [
            'parish' => 'IBERIA',
            'cities' => ['Delcambre', 'New Iberia', 'Jeanerette', 'Loreauville',
                'Economic Development Dist. #1 (Tif Dist)', 'Dry Prong']
        ],
        [
            'parish' => 'IBERVILLE',
            'cities' => ['St. Gabriel']
        ],
        [
            'parish' => 'JACKSON',
            'cities' => ['Jonesboro', 'Hodge', 'East Hodge', 'North Hodge',
                'Eros', 'Town Of Chatham']
        ],
        [
            'parish' => 'JEFFERSON',
            'cities' => ['Westwego']
        ],
        [
            'parish' => 'JEFFERSON DAVIS',
            'cities' => ['Welsh', 'Elton', 'Jennings', 'Lake Arthur',
                'Fenton', 'Sales Tax District No. 1', 'Road Sales Tax District No 1']
        ],
        [
            'parish' => 'LAFAYETTE',
            'cities' => ['Lafayette City', 'Duson', 'Carencro', 'Youngsville',
                'Scott', 'Law Enforcement Sub-District #1 & Police Jury', 'Broussard',
                'Scott Apollo Dev Dist', 'Scott Dest Pt Dev Dist', 'Lafayette I-10 Corridor Dist @ Mile Marker 103',
                'I-49 Economic Development District (Carencro Tif District)']
        ],
        [
            'parish' => 'LAFOURCHE',
            'cities' => ['Thibodaux', 'Lockport', 'Golden Meadow', 'Road Tax Dist. 2',
                'South Lafourche Levee District', 'Road Sales Tax Dist 2 North',
                'Consolidated Dist A-Rd Dists 3, 5 & 6']
        ],
        [
            'parish' => 'LASALLE',
            'cities' => ['Jena', 'Olla']
        ],
        [
            'parish' => 'LINCOLN',
            'cities' => ['Ruston', 'Dubach', 'Grambling', 'Choudrant']
        ],
        [
            'parish' => 'LIVINGSTON',
            'cities' => ['Denham Springs', 'Livingston', 'Walker', 'Albany',
                'Springfield', 'Gravity Dr (Dist 1 Ward 2: Precincts 2-2-3, 2-2-3A, 2-2-6, 2-2-6A, & Dist 5 Portion 2-7-1)',
                'Gravity Dr ( Dist 5 Precincts 1-11-1, 1-11-3, Portion Of 1-11-2)', 'Gravity Drainage Sales Tax District #6',
                'School Tax District #22', 'Denham Springs Annexed Area', 'Sales Tax District #33 (Maurapas)']
        ],
        [
            'parish' => 'MADISON',
            'cities' => ['Tallulah', 'Richmond', 'Delta']
        ],
        [
            'parish' => 'MOREHOUSE',
            'cities' => ['Bastrop-(International Paper La. Mill)', 'Mer Rouge', 'Bonita', 'Collinston',
                'East Morehouse Parish School District', 'Sales Tax District #1-City Of Bastrop (Excluding International Paper Mill',
                'Oak Ridge']
        ],
        [
            'parish' => 'NATCHITOCHES',
            'cities' => ['Natchitoches', 'Campti', 'Robeline', 'Clarence', 'Natchez']
        ],
        [
            'parish' => 'ORLEANS',
            'cities' => ['Lake Forest']
        ],
        [
            'parish' => 'OUACHITA',
            'cities' => ['Monroe', 'West Monroe', 'Sterlington', 'Richwood', 'West Ouachita School District']
        ],
        [
            'parish' => 'PLAQUEMINES',
            'cities' => ['Plaquemine']
        ],
        [
            'parish' => 'POINTE COUPEE',
            'cities' => ['New Roads', 'Morganza', 'Livonia', 'Fordoche']
        ],
        [
            'parish' => 'RAPIDES',
            'cities' => ['Alexandria', 'Pineville', 'Glenmora', 'Lecompte', 'Ball',
                'Boyce', 'Woodworth', 'Village Of Forest Hill']
        ],
        [
            'parish' => 'RED RIVER',
            'cities' => ['Coushatta', 'Hall Summit']
        ],
        [
            'parish' => 'RICHLAND',
            'cities' => ['Rayville', 'Mangham', 'Delhi']
        ],
        [
            'parish' => 'SABINE',
            'cities' => ['Many', 'Pleasant Hill', 'Florien', 'Zwolle', 'Converse',
                'Sales Tax District #1']
        ],
        [
            'parish' => 'ST BERNARD',
            'cities' => ['Chalmette']
        ],
        [
            'parish' => 'ST CHARLES',
            'cities' => ['Hahnville']
        ],
        [
            'parish' => 'ST HELENA',
            'cities' => ['Greensburg']
        ],
        [
            'parish' => 'ST JAMES',
            'cities' => ['Gramercy', 'Lutcher']
        ],
        [
            'parish' => 'ST JOHN THE BAPTIST',
            'cities' => ['Reserve']
        ],
        [
            'parish' => 'ST LANDRY',
            'cities' => ['Opelousas', 'Arnaudville', 'Eunice', 'Sunset', 'Port Barre',
                'Cankton', 'Grand Coteau', 'Krotz Springs', 'Washington', 'Melville']
        ],
        [
            'parish' => 'ST MARTIN',
            'cities' => ['Arnaudville', 'Breaux Bridge', 'Henderson', 'St. Martinville', 'Parks',
                'Sales Tax Dist #2', 'Sales Tax District #1', 'Broussard', 'Breaux Bridge Annexed Area',
                'Breaux Bridge Economic Development Dist #1', 'St Martinville Annex']
        ],
        [
            'parish' => 'ST MARY',
            'cities' => ['Do Not Use 5100 Should Use 5102, 5103, or 5104', 'Morgan City',
                'Wards 5 & 8 (Berwick, Patterson, Bayou Vista With A Morgan City Address)',
                'Wards 1,2,3,4,7 & 10 (Centerville, Franklin, Charenton, Garden City, Some Parts Of Jeanerette)',
                'Wards 6 & 9 (Amelia & Siracusaville Which Use Morgan City Addresses With 70380 Zip Codes)']
        ],
        [
            'parish' => 'ST TAMMANY',
            'cities' => ['Covington', 'Abita Springs', 'Folsom', 'Madisonville', 'Mandeville',
                'Pearl River', 'Slidell', 'Sun', 'Fremaux Economic Dev District', 'Nord Du Lac Economic Develop',
                'Rooms To Go Econ Develop']
        ],
        [
            'parish' => 'TANGIPAHOA',
            'cities' => ['Amite', 'Hammond', 'Independence', 'Ponchatoula', 'Roseland',
                'Kentwood', 'Tangipahoa', 'Tickfaw', 'Fire Protection District #1']
        ],
        [
            'parish' => 'TENSAS',
            'cities' => ['Newellton', 'St. Joseph', 'Town Of Waterproof']
        ],
        [
            'parish' => 'TERREBONNE',
            'cities' => []
        ],
        [
            'parish' => 'UNION',
            'cities' => ['Farmerville', 'Bernice', 'Marion', 'Junction City']
        ],
        [
            'parish' => 'VERMILION',
            'cities' => ['Abbeville', 'Delcambre', 'Erath', 'Kaplan', 'Maurice',
                'Gueydan', 'Hospital Service District #1', 'Hospital Sales Tax District No 2',
                'Fire Protection District #1']
        ],
        [
            'parish' => 'VERNON',
            'cities' => ['Leesville', 'Rosepine', 'New Llano', 'Hornbeck']
        ],
        [
            'parish' => 'WASHINGTON',
            'cities' => ['Franklinton', 'Bogalusa', 'Angie', 'Washington Parish Ward 4',
                'Varnado', 'Sales Tax District #2']
        ],
        [
            'parish' => 'WEBSTER',
            'cities' => ['Minden', 'Cotton Valley', 'Springhill', 'Cullen', 'Sarepta',
                'Sibley', 'Dixie Inn', 'Dixie Inn Tax Dist #6', 'Parish Area Within Dist #6']
        ],
        [
            'parish' => 'WEST BATON ROUGE',
            'cities' => ['Port Allen']
        ],
        [
            'parish' => 'WEST CARROLL',
            'cities' => ['Oak Grove']
        ],
        [
            'parish' => 'WEST FELICIANA',
            'cities' => ['Town Of St. Francisville']
        ],
        [
            'parish' => 'WINN',
            'cities' => ['Winnfield']
        ],
    ];

    protected $city_offices = [
        'cities' => 'Alexandria;Amite;Baker;Bastrop;Breaux Bridge;Bunkie;Chalmette;Clinton;Colfax;Coushatta;Crowley;DeQuincy;Donaldsonville;Eunice;Farmerville;Franklinton;Golden Meadow;Gramercy;Greensburg;Hahnville;Hammond;Jennings;Jonesboro;Kinder;Lake Forest;Lake Providence;Livingston;Mansfield;Mandeville;Monroe;Napoleonville;New Roads;Oak Grove;Oakdale;Opelousas;Pineville;Plaquemine;Port Allen;Rayville;Reserve;Ruston;St. Francisville;Springhill;Sulphur;Vivian;West Monroe;Westwego;Winnfield;Vidalia',
        'fees' => '$3.00;$3.00;$3.00;$3.00;$3.00;$2.00;$3.00;$2.00;$3.00;$3.00;$3.00;$3.00;$3.00;$3.00;$2.00;$3.00;$3.00;$3.00;$2.00;$3.00;$3.00;$2.00;$3.00;$3.00;$2.00;$3.00;$3.00;$3.00;$3.00;$3.00;$2.00;$3.00;$3.00;$2.00;$3.00;$3.00;$3.00;$3.00;$3.00;$3.00;$3.00;$3.00;$3.00;$2.00;$2.00;$3.00;$3.00;$2.00;$3.00',
        'timestamps' => '12/1/2001-5/1/2014;1/23/2013-5/1/2014;8/1/2002-5/1/2014;1/1/2006-5/1/2014;3/1/2005-5/1/2014;7/1/1995-5/1/2014;7/16/2012-5/1/2014;10/1/1998-5/1/2014;3/31/2004-5/1/2014;1/1/2006-5/1/2014;5/1/1992-5/1/2014;11/1/2001-5/1/2014;5/1/2003-5/1/2014;6/1/2011-5/1/2014;11/1/1996-5/1/2014;6/1/2008-5/1/2014;1/1/2003-5/1/2014;2/1/2002-5/1/2014;6/1/1997-5/1/2014;7/1/2006-5/1/2014;3/1/2011-5/1/2014;1/1/1997-5/1/2014;2/28/2002-5/1/2014;7/1/2002-5/1/2014;12/1/1997-5/1/2014;9/1/2004-5/1/2014;9/1/2008-5/1/2014;2/28/2002-5/1/2014;3/1/2013-5/1/2014;12/1/2001-5/1/2014;6/1/1993-5/1/2014;11/1/2005-5/1/2014;10/1/2008-5/1/2014;7/1/1997-5/1/2014;10/1/2011-5/1/2014;10/1/2004-5/1/2014;2/24/2003-5/1/2014;4/1/2005-5/1/2014;2/1/2002-5/1/2014;6/1/2002-5/1/2014;9/1/2011-5/1/2014;3/1/2008-5/1/2014;7/1/2006-5/1/2014;3/1/1991-5/1/2014;1/1/1993-5/1/2014;12/1/2001-5/1/2014;8/1/2002-5/1/2014;2/1/1992-5/1/2014;8/1/2005-5/1/2014'
    ];

    protected $plate_types = [
        "Car Plate", "Commercial Plate", "Farm Plate", "Truck Plate", "Private Bus Plate",
        "Motorcycle Plate", "NONE", "Motor Home Plate", "Trailer Plate", "Exempt Plate", "Apportioned Plate", "Motor Bus Plate",
        "Permanent Trailer Plate", "1-Yr Trailer Plate", "4-Yr Trailer Plate", "1-Yr Farm Plate", "4-Yr Farm Plate", "Utility Trailer Plate",
        "Boat Trailer Plate", "2-Yr Commercial Plate", "1-Yr Commercial Plate"

    ];

    protected $la_license_truck_weight_fees = "
        [truck-0-6,000-$10.00-none]-
        [truck-6001-8000-$28.00-none]-
        [truck-8001-10000-$28.00-none]-
        [truck-10001-23999-$0.38/100 LBS-none]-
        [truck-24000-37999-$0.60/100 LBS-none]-
        [truck-38000-80000-$0.63/100 LBS-none]-
        [truck-80001-88000-$0.64/100 LBS-none]-
        [car-10000-23999-$0.38/100 LBS-none]-
        [car-24000-37999-$0.60/100 LBS-none]-
        [car-38000-80000-$0.63/100 LBS-none]-
        [car-80001-88000-$0.64/100 LBS-none]-
        [van-10000-23999-$0.38/100 LBS-none]-
        [van-24000-37999-$0.60/100 LBS-none]-
        [van-38000-80000-$0.63/100 LBS-none]-
        [van-80001-88000-$0.64/100 LBS-none]-
        [suv-10000-23999-$0.38/100 LBS-none]-
        [suv-24000-37999-$0.60/100 LBS-none]-
        [suv-38000-80000-$0.63/100 LBS-none]-
        [suv-80001-88000-$0.64/100 LBS-none]-
        [truck tractor-10000-23999-$0.38/100 LBS-none]-
        [truck tractor-24000-37999-$0.60/100 LBS-none]-
        [truck tractor-38000-80000-$0.63/100 LBS-none]-
        [truck tractor-80001-88000-$0.64/100 LBS-none]-
        [truck-0-6,000-$3.00-Farm Plate]-
        [truck-6001-10000-$3.00-Farm Plate]-
        [truck-10001-23999-$10.00-Farm Plate]-
        [truck-24000-43999-$20.00-Farm Plate]-
        [truck-44000-65999-$30.00-Farm Plate]-
        [truck-66000-88000-$40.00-Farm Plate]-
        [car-10000-23999-$10.00-Farm Plate]-
        [car-24000-43999-$20.00-Farm Plate]-
        [car-44000-65999-$30.00-Farm Plate]-
        [car-66000-88000-$40.00-Farm Plate]-
        [van-10000-23999-$10.00-Farm Plate]-
        [van-24000-43999-$20.00-Farm Plate]-
        [van-44000-65999-$30.00-Farm Plate]-
        [van-66000-88000-$40.00-Farm Plate]-
        [suv-10000-23999-$10.00-Farm Plate]-
        [suv-24000-43999-$20.00-Farm Plate]-
        [suv-44000-65999-$30.00-Farm Plate]-
        [suv-66000-88000-$40.00-Farm Plate]-
        [truck tractor-0-6000-$3.00-Farm Plate]-
        [truck tractor-6001-10000-$3.00-Farm Plate]-
        [truck tractor-10001-23999-$10.00-Farm Plate]-
        [truck tractor-24000-43999-$20.00-Farm Plate]-
        [truck tractor-44000-65999-$30.00-Farm Plate]-
        [truck tractor-66000-88000-$40.00-Farm Plate]-
    ";

    protected $sales_tax =
        "[ACADIA<->PARISH ONLY<->none<->none<->none<->none<->100<->4/1/2012<->0.0425<->0.02<->5/1/2014<->12/31/2099]-
                    [ACADIA<->Crowley<->101<->7/1/2012<->0.025<->0.02<->100<->10/1/2004<->0.03<->0.02<->5/1/2014<->12/31/2099]-
                    [ACADIA<->Churchpoint<->102<->7/1/2012<->0.02<->0.02<->100<->10/1/2004<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [ACADIA<->Estherwood<->103<->3/1/1969<->0.01<->0.02<->100<->4/1/1997<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [ACADIA<->Iota<->104<->1/1/1992<->0.02<->0.02<->100<->4/1/1997<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [ACADIA<->Morse<->105<->8/1/1967<->0.01<->0.02<->100<->4/1/1997<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [ACADIA<->Rayne<->106<->12/1/1978<->0.02<->0.02<->100<->4/1/1997<->0.03<->0.02<->5/1/2014<->12/31/2099]-
                    [ACADIA<->Mermentau<->107<->10/1/1979<->0.01<->0.02<->100<->3/1/2013<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [ACADIA<->Eunice<->108<->1/1/2003<->0.022<->0.02<->100<->3/1/2013<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [ACADIA<->City-Of-Basile<->109<->6/1/2010<->0.02<->0.02<->100<->3/1/2013<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [ACADIA<->City-Of-Duson<->110<->6/1/2010<->0.02<->0.02<->100<->3/1/2013<->0.0325<->0.02<->5/1/2014<->12/31/2099
                    [ALLEN<->PARISH ONLY<->none<->none<->none<->none<->200<->3/1/2013<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [ALLEN<->Oakdale<->202<->4/1/2004<->0.013<->0.02<->200<->10/1/2006<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [ALLEN<->Oberlin<->203<->1/1/2005<->0.013<->0.02<->200<->10/1/2006<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [ALLEN<->Elizabeth<->204<->11/11/1986<->0.013<->0.02<->200<->10/1/1998<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [ALLEN<->Kinder<->205<->1/1/2007<->0.013<->0.02<->200<->6/1/1980<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [ALLEN<->Village Of Reeves<->206<->1/1/2010<->0.01<->0.02<->200<->10/1/1994<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [ASCENSION EAST<->PARISH ONLY<->none<->none<->none<->none<->304<->6/1/1980<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [ASCENSION EAST<->Gonzales<->302<->7/1/2001<->0.025<->0.02<->304<->10/1/1994<->0.02<->0.02<->5/1/2014<->12/31/2099]-
                    [ASCENSION EAST<->East Ascension (East Bank)<->304<->12/1/1984<->0.05<->0.02<->304<->10/1/2005<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [ASCENSION EAST<->Sorrento<->305<->12/1/1986<->0.025<->0.02<->304<->7/1/1992<->0.02<->0.02<->5/1/2014<->12/31/2099]-
                    [ASCENSION EAST<->Gonzales-Tanger Mall Dev Dist<->306<->7/1/2012<->0.035<->0.02<->304<->10/1/2005<->0.02<->0.02<->5/1/2014<->12/31/2099]-
                    [ASCENSION WEST<->PARISH ONLY<->none<->none<->none<->none<->303<->3/1/1982<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [ASCENSION WEST<->Donaldsonville<->301<->7/1/2012<->0.03<->0.02<->303<->1/1/2012<->0.02<->0.02<->5/1/2014<->12/31/2099]-
                    [ASCENSION WEST<->West Ascension Hospital Service (West Bank)<->303<->3/1/1981<->0.05<->0.02<->303<->7/1/2010<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [ASSUMPTION<->PARISH ONLY<->none<->none<->none<->none<->400<->1/1/2012<->0.05<->0.02<->5/1/2014<->12/31/2099]-
                    [ASSUMPTION<->Napoleonville<->401<->8/1/1967<->0.01<->0.02<->400<->1/1/2012<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [AVOYELLES<->PARISH ONLY<->none<->none<->none<->none<->500<->8/1/2002<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [AVOYELLES<->Cottonport<->501<->4/1/1996<->0.01<->0.02<->500<->8/1/2002<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [AVOYELLES<->Bunkie<->502<->1/1/2007<->0.02<->0.02<->500<->8/1/2002<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [AVOYELLES<->Plaucheville<->503<->2/1/1995<->0.01<->0.02<->500<->8/1/2002<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [AVOYELLES<->Moreauville<->504<->7/1/1998<->0.015<->0.02<->500<->8/1/2002<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [AVOYELLES<->Marksville<->505<->10/1/1996<->0.02<->0.02<->500<->2/1/2013<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [AVOYELLES<->Simmesport<->506<->9/1/1992<->0.02<->0.02<->500<->2/1/2013<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [AVOYELLES<->Mansura<->507<->7/1/2002<->0.02<->0.02<->500<->2/1/2013<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [AVOYELLES<->Hessmer<->508<->1/1/2004<->0.01<->0.02<->500<->7/1/2004<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [BEAUREGARD<->PARISH ONLY<->none<->none<->none<->none<->600<->7/1/2004<->0.0475<->0.015<->5/1/2014<->12/31/2099]-
                    [BEAUREGARD<->Deridder<->601<->10/1/2004<->0.025<->0.015<->600<->7/1/2004<->0.0275<->0.015<->5/1/2014<->12/31/2099]-
                    [BEAUREGARD<->Merryville<->602<->7/1/1997<->0.03<->0.015<->600<->7/1/2004<->0.0175<->0.015<->5/1/2014<->12/31/2099]-
                    [BIENVILLE<->PARISH ONLY<->none<->none<->none<->none<->700<->7/1/1994<->0.03<->0.02<->5/1/2014<->12/31/2099]-
                    [BIENVILLE<->Ringgold<->701<->1/1/1993<->0.02<->0.02<->700<->1/1/2005<->0.03<->0.02<->5/1/2014<->12/31/2099]-
                    [BIENVILLE<->Town Of Arcadia<->703<->1/1/2013<->0.025<->0.02<->700<->1/1/2005<->0.03<->0.02<->5/1/2014<->12/31/2099]-
                    [BIENVILLE<->Gibsland<->704<->1/1/2013<->0.02<->0.02<->700<->4/1/2004<->0.03<->0.02<->5/1/2014<->12/31/2099]-
                    [BIENVILLE<->Castor<->705<->1/1/2013<->0.01<->0.02<->700<->4/1/2004<->0.03<->0.02<->5/1/2014<->12/31/2099]-
                    [BOSSIER<->PARISH ONLY<->none<->none<->none<->none<->800<->4/1/2004<->0.0425<->0.01<->5/1/2014<->12/31/2099]-
                    [BOSSIER<->Bossier City<->801<->10/1/1991<->0.025<->0.01<->800<->10/1/2000<->0.025<->0.01<->5/1/2014<->12/31/2099]-
                    [BOSSIER<->Plain Dealing<->802<->7/1/2003<->0.025<->0.01<->800<->1/1/2013<->0.0275<->0.01<->5/1/2014<->12/31/2099]-
                    [BOSSIER<->Benton<->803<->7/1/1990<->0.025<->0.01<->800<->1/1/2013<->0.0275<->0.01<->5/1/2014<->12/31/2099]-
                    [BOSSIER<->Haughton<->804<->7/1/1990<->0.025<->0.01<->800<->1/1/2013<->0.0275<->0.01<->5/1/2014<->12/31/2099]-
                    [BOSSIER<->Shreveport <->809<->1/2/1990<->0.0275<->0.00<->800<->1/1/2013<->0.025<->0.01<->5/1/2014<->12/31/2099]-
                    [CADDO<->PARISH ONLY<->none<->none<->none<->none<->900<->1/1/2013<->0.0335<->0.00<->5/1/2014<->12/31/2099]-
                    [CADDO<->Oil City<->902<->7/1/2012<->0.02<->0.00<->910<->1/1/2013<->0.0335<->0.00<->5/1/2014<->12/31/2099]-
                    [CADDO<->Vivian<->903<->7/1/2012<->0.035<->0.00<->910<->1/1/2013<->0.0185<->0.00<->5/1/2014<->12/31/2099]-
                    [CADDO<->Shreveport<->904<->1/1/2007<->0.0275<->0.00<->900<->1/1/2013<->0.0185<->0.00<->5/1/2014<->12/31/2099]-
                    [CADDO<->Mooringsport<->905<->7/1/2012<->0.02<->0.00<->910<->1/1/2013<->0.0335<->0.00<->5/1/2014<->12/31/2099]-
                    [CADDO<->Greenwood<->906<->2/1/1990<->0.01<->0.00<->900<->1/1/2013<->0.0335<->0.00<->5/1/2014<->12/31/2099]-
                    [CADDO<->Rodessa<->907<->7/1/2012<->0.02<->0.00<->910<->1/1/2013<->0.0335<->0.00<->5/1/2014<->12/31/2099]-
                    [CADDO<->Blanchard<->908<->7/1/1997<->0.01<->0.00<->900<->1/1/2013<->0.0335<->0.00<->5/1/2014<->12/31/2099]-
                    [CADDO<->Village Of Ida<->909<->7/1/2012<->0.03<->0.00<->910<->1/1/2013<->0.0335<->0.00<->5/1/2014<->12/31/2099]-
                    [CADDO<->N. Caddo Hospital Dist<->Parish<->910<->7/1/2012<->0.01<->0.00<->900<->1/1/2013<->0.0335<->0.00<->5/1/2014<->12/31/2099]-
                    [CADDO<->PARISH ONLY<->none<->none<->none<->none<->910<->1/1/2013<->0.0335<->0.00<->5/1/2014<->12/31/2099]-
                    [CALCASIEU<->PARISH ONLY<->none<->none<->none<->none<->1000<->10/1/2000<->0.0275<->0.01<->5/1/2014<->12/31/2099]-
                    [CALCASIEU<->Lake Charles<->1001<->1/1/2007<->0.0225<->0.01<->1000<->1/1/2013<->0.0275<->0.01<->5/1/2014<->12/31/2099]-
                    [CALCASIEU<->Sulphur<->1002<->4/1/2011<->0.025<->0.01<->1000<->1/1/2013<->0.0275<->0.01<->5/1/2014<->12/31/2099]-
                    [CALCASIEU<->Iowa<->1003<->7/1/2012<->0.025<->0.01<->1000<->1/1/2013<->0.0275<->0.01<->5/1/2014<->12/31/2099]-
                    [CALCASIEU<->Dequincy<->1004<->1/1/2011<->0.025<->0.01<->1000<->1/1/2013<->0.0275<->0.01<->5/1/2014<->12/31/2099]-
                    [CALCASIEU<->Westlake<->1005<->10/1/2007<->0.025<->0.01<->1000<->1/1/2013<->0.0275<->0.01<->5/1/2014<->12/31/2099]-
                    [CALCASIEU<->Vinton<->1006<->1/1/2013<->0.025<->0.01<->1000<->1/1/2013<->0.0275<->0.01<->5/1/2014<->12/31/2099]-
                    [CALCASIEU<->Sales Tax Dist. 3 Unincorporated Ward #1 Only.<->1007<->10/1/1992<->0.015<->0.01<->1000<->1/1/2013<->0.0375<->0.01<->5/1/2014<->12/31/2099]-
                    [CALCASIEU<->Sales Tax District 4A<->1008<->1/1/2011<->0.015<->0.01<->1000<->1/1/2013<->0.0375<->0.01<->5/1/2014<->12/31/2099]-
                    [CALDWELL<->PARISH ONLY<->none<->none<->none<->none<->1100<->4/1/1997<->0.05<->0.02<->5/1/2014<->12/31/2099]-
                    [CALDWELL<->Columbia<->1101<->1/1/1982<->0.01<->0.02<->1100<->4/1/1997<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [CAMERON<->PARISH ONLY<->none<->none<->none<->none<->1200<->none<->0<->0<->5/1/2014<->12/31/2099]-
                    [CATAHOULA<->PARISH ONLY<->none<->none<->none<->none<->1300<->1/1/2013<->0.06<->0.02<->5/1/2014<->12/31/2099]-
                    [CLAIBORNE<->PARISH ONLY<->none<->none<->none<->none<->1400<->1/1/2007<->0.0312<->0.02<->5/1/2014<->12/31/2099]-
                    [CLAIBORNE<->Haynesville<->1401<->3/1/1987<->0.02<->0.02<->1400<->1/1/2007<->0.0212<->0.02<->5/1/2014<->12/31/2099]-
                    [CLAIBORNE<->Homer<->1402<->1/1/2011<->0.0238<->0.02<->1400<->1/1/2007<->0.0212<->0.02<->5/1/2014<->12/31/2099]-
                    [CLAIBORNE<->Junction City<->1403<->6/1/1991<->0.01<->0<->1400<->1/1/2007<->0.0312<->0.02<->5/1/2014<->12/31/2099]-
                    [CONCORDIA<->PARISH ONLY<->none<->none<->none<->none<->1500<->1/1/2006<->0.0475<->0.02<->5/1/2014<->12/31/2099]-
                    [CONCORDIA<->Vidalia<->1501<->10/1/1999<->0.025<->0.02<->1500<->1/1/2011<->0.0225<->0.02<->5/1/2014<->12/31/2099]-
                    [CONCORDIA<->Ferriday<->1502<->1/1/2005<->0.025<->0.02<->1500<->1/1/2011<->0.0225<->0.02<->5/1/2014<->12/31/2099]-
                    [DESOTO<->PARISH ONLY<->none<->none<->none<->none<->1600<->7/1/2011<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [DESOTO<->Logansport<->1601<->3/1/1998<->0.01<->0.01<->1600<->7/1/2011<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [DESOTO<->Mansfield<->1602<->1/1/2009<->0.015<->0.01<->1600<->7/1/2011<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [DESOTO<->Stonewall<->1603<->6/1/1992<->0.01<->0.01<->1600<->7/1/2011<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [DESOTO<->South Mansfield<->1604<->1/1/1995<->0.01<->0.01<->1600<->7/1/2011<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [DESOTO<->Grand Cane<->1605<->1/1/1997<->0.01<->0.01<->1600<->7/1/2011<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [DESOTO<->Keachi<->1606<->1/1/1997<->0.01<->0.01<->1600<->7/1/2011<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [EAST BATON ROUGE<->PARISH ONLY<->none<->none<->none<->none<->1700<->7/1/2009<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [EAST BATON ROUGE<->Baton Rouge/ Ebrp School District<->1701<->3/1/1991<->0.02<->0.01<->1700<->7/1/2009<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [EAST BATON ROUGE<->Baker/Baker School District<->1702<->10/1/2001<->0.025<->0.01<->1700<->7/1/2009<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [EAST BATON ROUGE<->Central/Central School District<->1703<->8/1/2005<->0.02<->0.01<->1700<->7/1/2009<->0.035<->0.01<->5/1/2014<->12/31/2099]-
                    [EAST BATON ROUGE<->Zachary/Zachary School District<->1705<->3/1/1989<->0.02<->0.01<->1700<->7/1/2009<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [EAST BATON ROUGE<->Zachary School Dist/Ebr Parish<->1706<->none<->0<->0<->1700<->7/1/2009<->0.05<->0.01<->5/1/2014<->12/31/2099]-
                    [EAST BATON ROUGE<->City Of Baker/Ebr Parish School Dist<->1707<->3/1/2010<->0.025<->0.01<->1700<->7/1/2009<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [EAST BATON ROUGE<->Ebr Parish/Central School Dist<->1708<->none<->0<->0<->1700<->7/1/2009<->0.055<->0.01<->5/1/2014<->12/31/2099]-
                    [EAST CARROLL<->PARISH ONLY<->none<->none<->none<->none<->1800<->1/1/2009<->0.05<->0.02<->5/1/2014<->12/31/2099]-
                    [EAST CARROLL<->Lake Providence<->1801<->1/1/2009<->0.02<->0.02<->1800<->1/1/2009<->0.05<->0.02<->5/1/2014<->12/31/2099]-
                    [EAST FELICIANA<->PARISH ONLY<->none<->none<->none<->none<->1900<->7/1/2007<->0.05<->0.02<->5/1/2014<->12/31/2099]-
                    [EVANGENLINE<->PARISH ONLY<->none<->none<->none<->none<->2008<->1/1/1999<->0<->0<->5/1/2014<->12/31/2099]-
                    [EVANGENLINE<->PARISH ONLY<->none<->none<->none<->none<->2007<->1/1/1999<->0<->0<->5/1/2014<->12/31/2099]-
                    [EVANGENLINE<->Ville Platte<->2001<->1/1/2001<->0.02<->0.02<->2007<->7/1/2001<->0.03<->0.02<->5/1/2014<->12/31/2099]-
                    [EVANGENLINE<->Basile<->2002<->11/1/1980<->0.02<->0.02<->2007<->7/1/2001<->0.03<->0.02<->5/1/2014<->12/31/2099]-
                    [EVANGENLINE<->Mamou<->2003<->10/1/2011<->0.02<->0.02<->2007<->7/1/2001<->0.03<->0.02<->5/1/2014<->12/31/2099]-
                    [EVANGENLINE<->Pine Prairie<->2004<->1/1/2008<->0.02<->0.02<->2007<->7/1/2001<->0.03<->0.02<->5/1/2014<->12/31/2099]-
                    [EVANGENLINE<->Chataignier<->2005<->7/1/1991<->0.02<->0.02<->2007<->7/1/2001<->0.03<->0.02<->5/1/2014<->12/31/2099]-
                    [EVANGENLINE<->Turkey Creek<->2006<->1/1/1997<->0.02<->0.02<->2007<->7/1/2001<->0.03<->0.02<->5/1/2014<->12/31/2099]-
                    [EVANGENLINE<->Rural Evangeline Except Ward 2<->2007<->10/1/1998<->0.02<->0.02<->2007<->7/1/2001<->0.03<->0.02<->5/1/2014<->12/31/2099]-
                    [EVANGENLINE<->Rural Evangeline Ward 2 Only<->2008<->none<->0<->0<->2008<->5/1/2003<->0.03<->0.02<->5/1/2014<->12/31/2099]-
                    [FRANKLIN<->PARISH ONLY<->none<->none<->none<->none<->2100<->1/1/2013<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [FRANKLIN<->Winnsboro<->2101<->1/1/2009<->0.02<->0.01<->2100<->1/1/2013<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [FRANKLIN<->Wisner<->2102<->1/1/1977<->0.01<->0.01<->2100<->1/1/2013<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [FRANKLIN<->Gilbert<->2103<->2/1/1995<->0.01<->0.02<->2100<->1/1/2013<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [FRANKLIN<->Village Of Baskin<->2104<->1/1/2007<->0.01<->0.01<->2100<->1/1/2013<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [GRANT<->PARISH ONLY<->none<->none<->none<->none<->2200<->1/1/2010<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [GRANT<->Colfax<->2201<->1/1/2003<->0.02<->0.02<->2200<->1/1/2010<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [GRANT<->Pollock<->2202<->3/10/1980<->0.01<->0.02<->2200<->1/1/2010<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [GRANT<->Georgetown<->2203<->1/1/2006<->0.02<->0.02<->2200<->1/1/2010<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [GRANT<->Creola<->2204<->1/1/2003<->0.02<->0.02<->2200<->1/1/2010<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [GRANT<->Montgomery<->2205<->4/1/2005<->0.01<->0.02<->2200<->1/1/2010<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [GRANT<->Dry Prong<->2206<->5/1/2010<->0.01<->0.02<->2200<->1/1/2010<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [IBERIA<->PARISH ONLY<->none<->none<->none<->none<->2300<->10/1/2000<->0.0325<->0.01<->5/1/2014<->12/31/2099]-
                    [IBERIA<->Delcambre<->2301<->1/1/1965<->0.01<->0.01<->2300<->10/1/2000<->0.0275<->0.01<->5/1/2014<->12/31/2099]-
                    [IBERIA<->New Iberia<->2304<->1/1/2004<->0.02<->0.01<->2300<->10/1/2000<->0.025<->0.01<->5/1/2014<->12/31/2099]-
                    [IBERIA<->Jeanerette<->2305<->4/1/2004<->0.0175<->0.01<->2300<->10/1/2000<->0.0275<->0.01<->5/1/2014<->12/31/2099]-
                    [IBERIA<->Loreauville<->2306<->1/1/1995<->0.015<->0.01<->2300<->10/1/2000<->0.0275<->0.01<->5/1/2014<->12/31/2099]-
                    [IBERIA<->Economic Development Dist. #1 (Tif Dist)<->2307<->1/1/2011<->0.01<->0.01<->2300<->10/1/2000<->0.0325<->0.01<->5/1/2014<->12/31/2099]-
                    [IBERVILLE<->PARISH ONLY<->none<->none<->none<->none<->2400<->1/1/2009<->0.05<->0.015<->5/1/2014<->12/31/2099]-
                    [IBERVILLE<->St. Gabriel<->2401<->8/1/2010<->0.01<->0.015<->2400<->1/1/2008<->0.0466<->0.015<->5/1/2014<->12/31/2099]-
                    [JACKSON<->PARISH ONLY<->none<->none<->none<->none<->2500<->7/1/2006<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [JACKSON<->Jonesboro<->2501<->4/1/1980<->0.02<->0.02<->2500<->7/1/2006<->0.03<->0.02<->5/1/2014<->12/31/2099]-
                    [JACKSON<->Hodge<->2502<->12/1/1983<->0.01<->0.02<->2500<->7/1/2006<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [JACKSON<->East Hodge<->2503<->12/1/1984<->0.01<->0.02<->2500<->7/1/2006<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [JACKSON<->North Hodge<->2504<->10/1/1982<->0.01<->0.02<->2500<->7/1/2006<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [JACKSON<->Eros<->2505<->1/1/2013<->0.01<->0.02<->2500<->7/1/2006<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [JACKSON<->Town Of Chatham<->2506<->4/1/2008<->0.01<->0.02<->2500<->7/1/2006<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [JEFFERSON<->PARISH ONLY<->none<->none<->none<->none<->2600<->1/1/1994<->0.0475<->0.01<->5/1/2014<->12/31/2099]-
                    [JEFFERSON DAVIS<->PARISH ONLY<->none<->none<->none<->none<->2700<->12/1/1997<->0.02<->0.02<->5/1/2014<->12/31/2099]-
                    [JEFFERSON DAVIS<->Welsh<->2701<->4/1/2011<->0.02<->0.02<->2700<->1/1/2008<->0.025<->0.02<->5/1/2014<->12/31/2099]-
                    [JEFFERSON DAVIS<->Elton<->2702<->1/1/2011<->0.02<->0.02<->2700<->1/1/2008<->0.025<->0.02<->5/1/2014<->12/31/2099]-
                    [JEFFERSON DAVIS<->Jennings<->2703<->1/1/2002<->0.025<->0.02<->2700<->1/1/2008<->0.025<->0.02<->5/1/2014<->12/31/2099]-
                    [JEFFERSON DAVIS<->Lake Arthur<->2704<->7/1/2003<->0.025<->0.02<->2700<->1/1/2008<->0.025<->0.02<->5/1/2014<->12/31/2099]-
                    [JEFFERSON DAVIS<->Fenton<->2705<->1/1/1995<->0.02<->0.02<->2700<->1/1/2008<->0.025<->0.02<->5/1/2014<->12/31/2099]-
                    [JEFFERSON DAVIS<->Sales Tax District No. 1<->2706<->1/1/2007<->0.025<->0.02<->2700<->1/1/2008<->0.025<->0.02<->5/1/2014<->12/31/2099]-
                    [JEFFERSON DAVIS<->Road Sales Tax District No 1<->2707<->1/1/2007<->0.02<->0.02<->2700<->1/1/2008<->0.025<->0.02<->5/1/2014<->12/31/2099]-
                    [LAFAYETTE<->PARISH ONLY<->none<->none<->none<->none<->2800<->1/1/2002<->0.02<->0<->5/1/2014<->12/31/2099]-
                    [LAFAYETTE<->Lafayette City<->2801<->7/1/1985<->0.02<->0.02<->2800<->1/1/2002<->0.02<->0<->5/1/2014<->12/31/2099]-
                    [LAFAYETTE<->Duson<->2802<->4/1/1992<->0.02<->0.02<->2800<->1/1/2002<->0.02<->0<->5/1/2014<->12/31/2099]-
                    [LAFAYETTE<->Carencro<->2803<->7/1/2011<->0.02<->0<->2800<->1/1/2002<->0.02<->0<->5/1/2014<->12/31/2099]-
                    [LAFAYETTE<->Youngsville<->2804<->4/1/2012<->0.035<->0.006<->2800<->1/1/2002<->0.02<->0<->5/1/2014<->12/31/2099]-
                    [LAFAYETTE<->Scott<->2805<->7/1/2011<->0.02<->0<->2800<->1/1/2002<->0.02<->0<->5/1/2014<->12/31/2099]-
                    [LAFAYETTE<->Law Enforcement Sub-District #1 & Police Jury<->2806<->1/1/2003<->0.02<->0.02<->2800<->1/1/2002<->0.02<->0<->5/1/2014<->12/31/2099]-
                    [LAFAYETTE<->Broussard<->2807<->4/1/2012<->0.025<->0.008<->2800<->1/1/2002<->0.02<->0<->5/1/2014<->12/31/2099]-
                    [LAFAYETTE<->Scott Apollo Dev Dist<->2809<->7/1/2011<->0.03<->0.003<->2800<->1/1/2002<->0.02<->0<->5/1/2014<->12/31/2099]-
                    [LAFAYETTE<->Scott Dest Pt Dev Dist<->2810<->7/1/2011<->0.03<->0.003<->2800<->1/1/2002<->0.02<->0<->5/1/2014<->12/31/2099]-
                    [LAFAYETTE<->Lafayette I<->10 Corridor Dist @ Mile Marker 103<->2812<->1/1/2008<->0.03<->0<->2800<->1/1/2002<->0.02<->0<->5/1/2014<->12/31/2099]-
                    [LAFAYETTE<->I-49 Economic Development District (Carencro Tif District)<->none<->7/1/2011<->0.03<->0.004<->2800<->1/1/2002<->0.02<->0<->5/1/2014<->12/31/2099]-
                    [LAFOURCHE<->PARISH ONLY<->none<->none<->none<->none<->2900<->8/1/2000<->0.037<->0.011<->5/1/2014<->12/31/2099]-
                    [LAFOURCHE<->Thibodaux<->2901<->3/1/1993<->0.02<->0.011<->2900<->8/1/2000<->0.02<->0.011<->5/1/2014<->12/31/2099]-
                    [LAFOURCHE<->Lockport<->2902<->7/1/2010<->0.02<->0.011<->2900<->8/1/2000<->0.027<->0.011<->5/1/2014<->12/31/2099]-
                    [LAFOURCHE<->Golden Meadow<->2903<->1/1/2008<->0.025<->0.011<->2900<->8/1/2000<->0.027<->0.011<->5/1/2014<->12/31/2099]-
                    [LAFOURCHE<->Road Tax Dist. 2<->2904<->1/1/2008<->0.015<->0.011<->2900<->8/1/2000<->0.037<->0.011<->5/1/2014<->12/31/2099]-
                    [LAFOURCHE<->South Lafourche Levee District<->2908<->1/1/2008<->0.015<->0.011<->2900<->8/1/2000<->0.037<->0.011<->5/1/2014<->12/31/2099]-
                    [LAFOURCHE<->Road Sales Tax Dist 2 North<->2902<->1/1/2008<->0.005<->0.011<->2900<->8/1/2000<->0.037<->0.011<->5/1/2014<->12/31/2099]-
                    [LAFOURCHE<->Consolidated Dist A-Rd Dists 3, 5 & 6<->2910<->8/1/2000<->0.01<->0.011<->2900<->8/1/2000<->0.037<->0.011<->5/1/2014<->12/31/2099]-
                    [LASALLE<->PARISH ONLY<->none<->none<->none<->none<->3000<->7/1/2008<->0.035<->0.015<->5/1/2014<->12/31/2099]-
                    [LASALLE<->Jena<->3001<->7/1/1990<->0.01<->0.015<->3000<->7/1/2008<->0.035<->0.015<->5/1/2014<->12/31/2099]-
                    [LASALLE<->Olla<->3002<->1/1/1996<->0.01<->0.015<->3000<->7/1/2008<->0.035<->0.015<->5/1/2014<->12/31/2099]-
                    [LINCOLN<->PARISH ONLY<->none<->none<->none<->none<->3100<->7/1/2012<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [LINCOLN<->Ruston<->3101<->1/1/1990<->0.0175<->0.02<->3100<->7/1/2012<->0.03<->0.02<->5/1/2014<->12/31/2099]-
                    [LINCOLN<->Dubach<->3102<->2/2/1982<->0.01<->0.01<->3100<->7/1/2012<->0.0325<->0.02<->5/1/2014<->12/31/2099]-
                    [LINCOLN<->Grambling<->3103<->1/1/1987<->0.02<->0.02<->3100<->7/1/2012<->0.03<->0.02<->5/1/2014<->12/31/2099]-
                    [LINCOLN<->Choudrant<->3104<->1/1/2004<->0.0125<->0.02<->3100<->7/1/2012<->0.03<->0.02<->5/1/2014<->12/31/2099]-
                    [LIVINGSTON<->PARISH ONLY<->none<->none<->none<->none<->3200<->10/1/1997<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [LIVINGSTON<->Denham Springs<->3201<->10/1/1988<->0.015<->0.01<->3200<->10/1/1997<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [LIVINGSTON<->Livingston<->3202<->10/1/1962<->0.01<->0.01<->3200<->10/1/1997<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [LIVINGSTON<->Walker<->3203<->4/1/2000<->0.02<->0.01<->3200<->10/1/1997<->0.035<->0.01<->5/1/2014<->12/31/2099]-
                    [LIVINGSTON<->Albany<->3204<->12/1/1975<->0.01<->0.01<->3200<->10/1/1997<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [LIVINGSTON<->Springfield<->3205<->1/1/2005<->0.015<->0.01<->3200<->10/1/1997<->0.035<->0.01<->5/1/2014<->12/31/2099]-
                    [LIVINGSTON<->Gravity Dr (Dist 1 Ward 2: Precincts 2<->2<->3, 2<->2<->3A, 2<->2<->6, 2<->2<->6A, & Dist 5 Portion 2<->7<->1)<->3206<->6/1/1985<->0.005<->0.01<->3200<->10/1/1997<->[0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [LIVINGSTON<->Gravity Dr ( Dist 5 Precincts 1<->11<->1, 1<->11<->3, Portion Of 1<->11<->2)<->3207<->8/1/1995<->0.005<->0.01<->3200<->10/1/1997<->0.04<->0.[01<->5/1/2014<->12/31/2099]-
                    [LIVINGSTON<->Gravity Drainage Sales Tax District #6<->3208<->7/1/1997<->0.005<->0.01<->3200<->10/1/1997<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [LIVINGSTON<->School Tax District #22<->3209<->10/1/2007<->0.015<->0.01<->3200<->10/1/1997<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [LIVINGSTON<->Denham Springs Annexed Area<->3210<->10/1/2004<->0.02<->0.01<->3200<->10/1/1997<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [LIVINGSTON<->Sales Tax District #33 (Maurapas)<->3211<->1/1/2005<->0.01<->0.01<->3200<->10/1/1997<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [MADISON<->PARISH ONLY<->none<->none<->none<->none<->3300<->1/1/2005<->0.035<->0.01<->5/1/2014<->12/31/2099]-
                    [MADISON<->Tallulah<->3301<->3/1/1987<->0.02<->0.01<->3300<->1/1/2005<->0.035<->0.01<->5/1/2014<->12/31/2099]-
                    [MADISON<->Richmond<->3302<->1/1/1990<->0.02<->0.01<->3300<->1/1/2005<->0.035<->0.01<->5/1/2014<->12/31/2099]-
                    [MADISON<->Delta<->3303<->6/1/2010<->0.01<->0.01<->3300<->1/1/2005<->0.035<->0.01<->5/1/2014<->12/31/2099]-
                    [MOREHOUSE<->PARISH ONLY<->none<->none<->none<->none<->3400<->8/1/2011<->0.04<->0.011<->5/1/2014<->12/31/2099]-
                    [MOREHOUSE<->Bastrop-(International Paper La. Mill)<->3401<->1/1/2000<->0.025<->0.011<->3400<->1/1/2010<->0.03<->0.011<->5/1/2014<->12/31/2099]-
                    [MOREHOUSE<->Mer Rouge<->3402<->7/1/2006<->0.02<->0.011<->3400<->1/1/2011<->0.035<->0.011<->5/1/2014<->12/31/2099]-
                    [MOREHOUSE<->Bonita<->3403<->7/1/2010<->0.02<->0.011<->3400<->1/1/2011<->0.035<->0.011<->5/1/2014<->12/31/2099]-
                    [MOREHOUSE<->Collinston<->3404<->1/1/2010<->0.02<->0.011<->3400<->1/1/2011<->0.035<->0.011<->5/1/2014<->12/31/2099]-
                    [MOREHOUSE<->East Morehouse Parish School District<->3405<->7/1/2006<->0<->0<->3400<->1/1/2010<->0.03<->0.011<->5/1/2014<->12/31/2099]-
                    [MOREHOUSE<->Sales Tax District #1-City Of Bastrop (Excluding International Paper Mill<->3406<->1/1/2005<->0.03<->0.01<->3400<->1/1/2010<->0.03<->0.[011<->5/1/2014<->12/31/2099]-
                    [MOREHOUSE<->Oak Ridge<->3407<->none<->0<->0<->3400<->2/1/2011<->0.035<->0.011<->5/1/2014<->12/31/2099]-
                    [NATCHITOCHES<->PARISH ONLY<->none<->none<->none<->none<->3500<->10/1/2006<->0.035<->0.02<->5/1/2014<->12/31/2099]-
                    [NATCHITOCHES<->Natchitoches<->3503<->1/1/1996<->0.025<->0.02<->3500<->10/1/2006<->0.025<->0.02<->5/1/2014<->12/31/2099]-
                    [NATCHITOCHES<->Campti<->3504<->1/1/1992<->0.02<->0.02<->3500<->10/1/2006<->0.035<->0.02<->5/1/2014<->12/31/2099]-
                    [NATCHITOCHES<->Robeline<->3505<->1/1/1995<->0.01<->0.02<->3500<->10/1/2006<->0.035<->0.02<->5/1/2014<->12/31/2099]-
                    [NATCHITOCHES<->Clarence<->3506<->7/1/1986<->0.01<->0.02<->3500<->10/1/2006<->0.035<->0.02<->5/1/2014<->12/31/2099]-
                    [NATCHITOCHES<->Natchez<->3507<->12/1/1986<->0.01<->0.02<->3500<->10/1/2006<->0.035<->0.02<->5/1/2014<->12/31/2099]-
                    [ORLEANS<->PARISH ONLY<->none<->none<->none<->none<->3600<->6/1/1985<->0.05<->0.01<->5/1/2014<->12/31/2099]-
                    [OUACHITA<->PARISH ONLY<->none<->none<->none<->none<->3700<->1/1/2013<->0.046<->0.01<->5/1/2014<->12/31/2099]-
                    [OUACHITA<->Monroe<->3701<->1/1/2005<->0.0549<->0.01<->3700<->1/1/2003<->0.005<->0.01<->5/1/2014<->12/31/2099]-
                    [OUACHITA<->West Monroe<->3702<->1/1/2007<->0.035<->0.01<->3700<->1/1/2013<->0.02<->0.01<->5/1/2014<->12/31/2099]-
                    [OUACHITA<->Sterlington<->3703<->9/1/1989<->0.015<->0.01<->3700<->1/1/2013<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [OUACHITA<->Richwood<->3704<->7/1/1989<->0.02<->0.01<->3700<->7/1/1996<->0.035<->0.01<->5/1/2014<->12/31/2099]-
                    [OUACHITA<->West Ouachita School District<->3705<->1/1/1998<->0.01<->0.01<->3700<->1/1/2013<->0.046<->0.01<->5/1/2014<->12/31/2099]-
                    [PLAQUEMINES<->PARISH ONLY<->none<->none<->none<->none<->3800<->2/1/2010<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [POINTE COUPEE<->PARISH ONLY<->none<->none<->none<->none<->3900<->7/1/2007<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [POINTE COUPEE<->New Roads<->3902<->9/1/1972<->0.01<->0.01<->3900<->7/1/2007<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [POINTE COUPEE<->Morganza<->3903<->12/1/1984<->0.01<->0.01<->3900<->7/1/2007<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [POINTE COUPEE<->Livonia<->3904<->3/1/1985<->0.01<->0.01<->3900<->7/1/2007<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [POINTE COUPEE<->Fordoche<->3905<->5/13/1986<->0.01<->0.01<->3900<->7/1/2007<->0.04<->0.01<->5/1/2014<->12/31/2099]-
                    [RAPIDES<->PARISH ONLY<->none<->none<->none<->none<->4000<->1/1/2003<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [RAPIDES<->Alexandria<->4001<->7/1/2008<->0.025<->0.01<->4000<->1/1/2003<->0.025<->0.01<->5/1/2014<->12/31/2099]-
                    [RAPIDES<->Pineville<->4002<->10/1/2005<->0.025<->0.01<->4000<->1/1/2003<->0.025<->0.01<->5/1/2014<->12/31/2099]-
                    [RAPIDES<->Glenmora<->4003<->1/1/2001<->0.015<->0.01<->4000<->1/1/2003<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [RAPIDES<->Lecompte<->4004<->1/1/2001<->0.015<->0.01<->4000<->1/1/2003<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [RAPIDES<->Ball<->4005<->10/1/2005<->0.02<->0.01<->4000<->1/1/2003<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [RAPIDES<->Boyce<->4006<->1/1/2001<->0.01<->0.01<->4000<->1/1/2003<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [RAPIDES<->Woodworth<->4007<->1/1/2001<->0.01<->0.01<->4000<->1/1/2003<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [RAPIDES<->Village Of Forest Hill<->4008<->10/1/2001<->0.005<->0.01<->4000<->1/1/2003<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [RED RIVER<->PARISH ONLY<->none<->none<->none<->none<->4100<->1/1/2009<->0.045<->0.02<->5/1/2014<->12/31/2099]-
                    [RED RIVER<->Coushatta<->4101<->9/1/1969<->0.01<->0.02<->4100<->1/1/2009<->0.045<->0.02<->5/1/2014<->12/31/2099]-
                    [RED RIVER<->Hall Summit<->4102<->8/1/1980<->0.01<->0.02<->4100<->1/1/2009<->0.045<->0.02<->5/1/2014<->12/31/2099]-
                    [RICHLAND<->PARISH ONLY<->none<->none<->none<->none<->4200<->1/1/2010<->0.04<->0.015<->5/1/2014<->12/31/2099]-
                    [RICHLAND<->Rayville<->4201<->3/1/2013<->0.005<->0.015<->4200<->1/1/2010<->0.04<->0.015<->5/1/2014<->12/31/2099]-
                    [RICHLAND<->Mangham<->4202<->9/1/1992<->0.01<->0.015<->4200<->1/1/2010<->0.04<->0.015<->5/1/2014<->12/31/2099]-
                    [RICHLAND<->Delhi<->4203<->1/1/2010<->0.015<->0.015<->4200<->1/1/2010<->0.04<->0.015<->5/1/2014<->12/31/2099]-
                    [SABINE<->PARISH ONLY<->none<->none<->none<->none<->4300<->1/1/2007<->none<->none<->5/1/2014<->12/31/2099]-
                    [SABINE<->Many<->4301<->3/1/2010<->0.015<->0.01<->4300<->1/1/2007<->0.04625<->0.01<->5/1/2014<->12/31/2099]-
                    [SABINE<->Pleasant Hill<->4302<->11/1/1981<->0.01<->0.01<->4300<->1/1/2007<->0.04125<->0.01<->5/1/2014<->12/31/2099]-
                    [SABINE<->Florien<->4303<->3/1/1993<->0.01<->0.01<->4300<->1/1/2007<->0.04625<->0.01<->5/1/2014<->12/31/2099]-
                    [SABINE<->Zwolle<->4304<->10/1/2005<->0.02<->0.01<->4300<->1/1/2007<->0.04625<->0.01<->5/1/2014<->12/31/2099]-
                    [SABINE<->Converse<->4305<->1/1/1993<->0.01<->0.01<->4300<->1/1/2007<->0.04625<->0.01<->5/1/2014<->12/31/2099]-
                    [SABINE<->Sales Tax District #1<->4306<->1/1/2000<->0.005<->0.01<->4300<->1/1/2007<->0.04125<->0.01<->5/1/2014<->12/31/2099]-
                    [ST BERNARD<->PARISH ONLY<->none<->none<->none<->none<->4400<->1/1/2003<->0.05<->0.015<->5/1/2014<->12/31/2099]-
                    [ORLEANS<->PARISH ONLY<->none<->none<->none<->none<->4500<->1/1/2002<->0.05<->0.02<->5/1/2014<->12/31/2099]-
                    [ST HELENA<->PARISH ONLY<->none<->none<->none<->none<->4600<->1/1/2008<->0.05<->0.01<->5/1/2014<->12/31/2099]-
                    [ST HELENA<->Greensburg<->4601<->10/1/1977<->0.01<->0.01<->4600<->1/1/2008<->0.05<->0.01<->5/1/2014<->12/31/2099]-
                    [ST JAMES<->PARISH ONLY<->none<->none<->none<->none<->4700<->7/1/2003<->0.035<->0.02<->5/1/2014<->12/31/2099]-
                    [ST JAMES<->Gramercy<->4701<->8/15/1977<->0.01<->0.02<->4700<->7/1/2003<->0.025<->0.02<->5/1/2014<->12/31/2099]-
                    [ST JAMES<->Lutcher<->4701<->8/15/1977<->0.01<->0.02<->4700<->7/1/2003<->0.025<->0.02<->5/1/2014<->12/31/2099]-
                    [ST JOHN THE BAPTIST<->PARISH ONLY<->none<->none<->none<->none<->4800<->1/1/2004<->0.0475<->0.02<->5/1/2014<->12/31/2099]-
                    [ST LANDRY<->PARISH ONLY<->none<->none<->none<->none<->4900<->4/1/2004<->0.0355<->0.02<->5/1/2014<->12/31/2099]-
                    [ST LANDRY<->Opelousas<->4901<->3/1/2012<->0.022<->0.011<->4900<->4/1/2004<->0.0355<->0.02<->5/1/2014<->12/31/2099]-
                    [ST LANDRY<->Arnaudville<->4902<->3/1/2012<->0.02<->0.011<->4900<->4/1/2004<->0.0355<->0.02<->5/1/2014<->12/31/2099]-
                    [ST LANDRY<->Eunice<->4903<->3/1/2012<->0.022<->0.011<->4900<->4/1/2004<->0.0355<->0.02<->5/1/2014<->12/31/2099]-
                    [ST LANDRY<->Sunset<->4904<->3/1/2012<->0.02<->0.011<->4900<->4/1/2004<->0.0355<->0.02<->5/1/2014<->12/31/2099]-
                    [ST LANDRY<->Port Barre<->4905<->3/1/2012<->0.022<->0.011<->4900<->4/1/2004<->0.0355<->0.02<->5/1/2014<->12/31/2099]-
                    [ST LANDRY<->Cankton<->4906<->3/1/2012<->0.01<->0.011<->4900<->4/1/2004<->0.0355<->0.02<->5/1/2014<->12/31/2099]-
                    [ST LANDRY<->Grand Coteau<->4907<->3/1/2012<->0.02<->0.011<->4900<->4/1/2004<->0.0355<->0.02<->5/1/2014<->12/31/2099]-
                    [ST LANDRY<->Krotz Springs<->4908<->3/1/2012<->0.01<->0.011<->4900<->4/1/2004<->0.0355<->0.02<->5/1/2014<->12/31/2099]-
                    [ST LANDRY<->Washington<->4909<->3/1/2012<->0.012<->0.02<->4900<->4/1/2004<->0.0355<->0.02<->5/1/2014<->12/31/2099]-
                    [ST LANDRY<->Melville<->4910<->4/1/2010<->0.022<->0.02<->4900<->4/1/2004<->0.0355<->0.02<->5/1/2014<->12/31/2099]-
                    [ST MARTIN<->PARISH ONLY<->none<->none<->none<->none<->5000<->1/1/1999<->0.015<->0.011<->5/1/2014<->12/31/2099]-
                    [ST MARTIN<->Arnaudville<->5001<->6/1/1982<->0.02<->0.02<->5000<->1/1/1999<->0.025<->0.011<->5/1/2014<->12/31/2099]-
                    [ST MARTIN<->Breaux Bridge<->5002<->2/1/1995<->0.01<->0.011<->5000<->1/1/1999<->0.025<->0.011<->5/1/2014<->12/31/2099]-
                    [ST MARTIN<->Henderson<->5003<->2/1/1995<->0.01<->0.011<->5000<->1/1/1999<->0.025<->0.011<->5/1/2014<->12/31/2099]-
                    [ST MARTIN<->St. Martinville<->5004<->7/1/2007<->0.02<->0.011<->5000<->1/1/1999<->0.025<->0.011<->5/1/2014<->12/31/2099]-
                    [ST MARTIN<->Parks<->5005<->6/1/2010<->0.02<->0.011<->5000<->1/1/1999<->0.025<->0.011<->5/1/2014<->12/31/2099]-
                    [ST MARTIN<->Sales Tax Dist #2<->5006<->4/1/1999<->0.01<->0.011<->5000<->1/1/1999<->0.025<->0.011<->5/1/2014<->12/31/2099]-
                    [ST MARTIN<->Sales Tax District #1<->5007<->10/1/2002<->0.01<->0.011<->5000<->1/1/1999<->0.025<->0.011<->5/1/2014<->12/31/2099]-
                    [ST MARTIN<->Broussard<->5008<->4/1/2012<->0.035<->0.008<->5000<->1/1/1999<->0.025<->0.011<->5/1/2014<->12/31/2099]-
                    [ST MARTIN<->Breaux Bridge Annexed Area<->5009<->4/1/2005<->0.02<->0.011<->5000<->1/1/1999<->0.025<->0.011<->5/1/2014<->12/31/2099]-
                    [ST MARTIN<->Breaux Bridge Economic Development Dist #1<->5010<->6/1/2010<->0.02<->0.011<->5000<->1/1/1999<->0.025<->0.011<->5/1/2014<->12/31/2099]-
                    [ST MARTIN<->St Martinville Annex<->5011<->6/1/2010<->0.02<->0.011<->5000<->1/1/1999<->0.035<->0.011<->5/1/2014<->12/31/2099]-

                    [ST MARY<->PARISH ONLY<->none<->none<->none<->none<->5100<->1/1/2009<->0.032<->0.02<->5/1/2014<->12/31/2099]-
                    [ST MARY<->Morgan City<->5101<->1/1/2012<->0.006<->0.02<->5100<->1/1/2009<->0.037<->0.02<->5/1/2014<->12/31/2099]-
                    [ST MARY<->Wards 5 & 8 (Berwick, Patterson, Bayou Vista With A Morgan City Address)<->5102<->7/1/1982<->0.003<->0.02<->5100<->1/1/2009<->0.037<->0.[02<->5/1/2014<->12/31/2099]-
                    [ST MARY<->Wards 1,2,3,4,7 & 10 (Centerville, Franklin, Charenton, Garden City, Some Parts Of Jeanerette)<->5103<->10/1/2008<->0.003<->0.02<->5100<->1/1/2009[<->0.037<->0.02<->5/1/2014<->12/31/2099]-
                    [ST MARY<->Wards 6 & 9 (Amelia & Siracusaville Which Use Morgan City Addresses With 70380 Zip Codes)<->5104<->1/1/1986<->0.003<->0.02<->5100<->1/1/2009<->0.037[<->0.02<->5/1/2014<->12/31/2099]-
                    [ST TAMMANY<->PARISH ONLY<->none<->none<->none<->none<->5200<->1/1/2001<->0.0475<->0.011<->5/1/2014<->12/31/2099]-
                    [ST TAMMANY<->Covington<->5201<->10/31/2009<->0.02<->0.011<->5200<->1/1/2001<->0.0275<->0.011<->5/1/2014<->12/31/2099]-
                    [ST TAMMANY<->Abita Springs<->5202<->10/1/1992<->0.02<->0.011<->5200<->1/1/2001<->0.0275<->0.011<->5/1/2014<->12/31/2099]-
                    [ST TAMMANY<->Folsom<->5203<->10/1/1995<->0.025<->0.011<->5200<->1/1/2001<->0.0275<->0.011<->5/1/2014<->12/31/2099]-
                    [ST TAMMANY<->Madisonville<->5204<->10/1/1992<->0.02<->0.011<->5200<->1/1/2001<->0.0275<->0.011<->5/1/2014<->12/31/2099]-
                    [ST TAMMANY<->Mandeville<->5205<->7/1/2011<->0.025<->0.011<->5200<->1/1/2001<->0.0275<->0.011<->5/1/2014<->12/31/2099]-
                    [ST TAMMANY<->Pearl River<->5206<->1/1/2012<->0.0225<->0.011<->5200<->1/1/2001<->0.0275<->0.011<->5/1/2014<->12/31/2099]-
                    [ST TAMMANY<->Slidell<->5207<->10/1/1992<->0.02<->0.011<->5200<->1/1/2001<->0.0275<->0.011<->5/1/2014<->12/31/2099]-
                    [ST TAMMANY<->Sun<->5208<->10/1/1992<->0.025<->0.011<->5200<->1/1/2001<->0.0275<->0.011<->5/1/2014<->12/31/2099]-
                    [ST TAMMANY<->Fremaux Economic Dev District<->5209<->7/1/2012<->0.015<->0.011<->5200<->1/1/2001<->0.0375<->0.011<->5/1/2014<->12/31/2099]-
                    [ST TAMMANY<->Nord Du Lac Economic Develop<->5210<->7/1/2010<->0.0075<->0.011<->5200<->1/1/2001<->0.0475<->0.011<->5/1/2014<->12/31/2099]-
                    [ST TAMMANY<->Rooms To Go Econ Develop<->5211<->7/1/2010<->0.0075<->0.011<->5200<->1/1/2001<->0.05<->0.011<->5/1/2014<->12/31/2099]-
                    [TANGIPAHOA<->PARISH ONLY<->none<->none<->none<->none<->5300<->1/1/2010<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [TANGIPAHOA<->Amite<->5301<->10/1/2003<->0.025<->0.01<->5300<->1/1/2010<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [TANGIPAHOA<->Hammond<->5302<->9/1/1982<->0.02<->0.01<->5300<->1/1/2010<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [TANGIPAHOA<->Independence<->5303<->7/1/2007<->0.025<->0.01<->5300<->1/1/2010<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [TANGIPAHOA<->Ponchatoula<->5304<->7/1/1982<->0.02<->0.01<->5300<->1/1/2010<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [TANGIPAHOA<->Roseland<->5305<->7/7/1982<->0.02<->0.01<->5300<->1/1/2010<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [TANGIPAHOA<->Kentwood<->5306<->7/1/2004<->0.02<->0.01<->5300<->1/1/2010<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [TANGIPAHOA<->Tangipahoa<->5307<->5/1/1985<->0.02<->0.01<->5300<->1/1/2010<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [TANGIPAHOA<->Tickfaw<->5308<->1/1/1991<->0.02<->0.01<->5300<->1/1/2010<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [TANGIPAHOA<->Fire Protection District #1<->5309<->10/1/2003<->0.005<->0.01<->5300<->1/1/2010<->0.03<->0.01<->5/1/2014<->12/31/2099]-
                    [TENSAS<->PARISH ONLY<->none<->none<->none<->none<->5400<->10/1/2009<->0.0525<->0.02<->5/1/2014<->12/31/2099]-
                    [TENSAS<->Newellton<->5401<->1/1/1994<->0.0075<->0.02<->5400<->10/1/2009<->0.0525<->0.02<->5/1/2014<->12/31/2099]-
                    [TENSAS<->St. Joseph<->5402<->1/1/1996<->0.01<->0.02<->5400<->10/1/2009<->0.0525<->0.02<->5/1/2014<->12/31/2099]-
                    [TENSAS<->Town Of Waterproof<->5403<->10/1/1999<->0.0075<->0.02<->5400<->10/1/2009<->0.0525<->0.02<->5/1/2014<->12/31/2099]-
                    [TERREBONNE<->PARISH ONLY<->none<->none<->none<->none<->5500<->4/1/2013<->0.05<->0.02<->5/1/2014<->12/31/2099]-
                    [UNION<->PARISH ONLY<->none<->none<->none<->none<->5600<->4/1/2012<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [UNION<->Farmerville<->5601<->8/1/2011<->0.02<->0.02<->5600<->4/1/2012<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [UNION<->Bernice<->5602<->7/1/2011<->0.02<->0.02<->5600<->4/1/2012<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [UNION<->Marion<->5603<->7/1/2011<->0.02<->0.02<->5600<->4/1/2012<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [UNION<->Junction City<->5604<->7/1/2011<->0.02<->0.02<->5600<->4/1/2012<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [VERMILION<->PARISH ONLY<->none<->none<->none<->none<->5700<->7/1/2009<->0.0375<->0.02<->5/1/2014<->12/31/2099]-
                    [VERMILION<->Abbeville<->5701<->10/1/2008<->0.0175<->0.02<->5700<->7/1/2009<->0.0375<->0.02<->5/1/2014<->12/31/2099]-
                    [VERMILION<->Delcambre<->5702<->10/1/2008<->0.015<->0.01<->5700<->7/1/2009<->0.0375<->0.02<->5/1/2014<->12/31/2099]-
                    [VERMILION<->Erath<->5703<->10/1/2008<->0.015<->0.01<->5700<->7/1/2009<->0.0375<->0.02<->5/1/2014<->12/31/2099]-
                    [VERMILION<->Kaplan<->5704<->4/1/2011<->0.02<->0.02<->5700<->7/1/2009<->0.0375<->0.02<->5/1/2014<->12/31/2099]-
                    [VERMILION<->Maurice<->5705<->10/1/2008<->0.02<->0.02<->5700<->7/1/2009<->0.0375<->0.02<->5/1/2014<->12/31/2099]-
                    [VERMILION<->Gueydan<->5706<->11/1/1982<->0.01<->0.015<->5700<->7/1/2009<->0.0375<->0.02<->5/1/2014<->12/31/2099]-
                    [VERMILION<->Hospital Service District #1<->5707<->4/1/2011<->0.01<->0.02<->5700<->7/1/2009<->0.0375<->0.02<->5/1/2014<->12/31/2099]-
                    [VERMILION<->Hospital Sales Tax District No 2<->5708<->10/1/2008<->0.005<->0.02<->5700<->7/1/2009<->0.0375<->0.02<->5/1/2014<->12/31/2099]-
                    [VERNON<->PARISH ONLY<->none<->none<->none<->none<->5800<->4/1/2006<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [VERNON<->Leesville<->5803<->7/1/2005<->0.015<->0.02<->5800<->4/1/2006<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [VERNON<->Rosepine<->5804<->3/1/2012<->0.015<->0.02<->5800<->4/1/2006<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [VERNON<->New Llano<->5805<->3/1/2010<->0.015<->0.02<->5800<->4/1/2006<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [VERNON<->Hornbeck<->5806<->2/1/1993<->0.01<->0.02<->5800<->4/1/2006<->0.04<->0.02<->5/1/2014<->12/31/2099]-
                    [WASHINGTON<->PARISH ONLY<->none<->none<->none<->none<->5900<->7/1/2002<->0.035<->0.01<->5/1/2014<->12/31/2099]-
                    [WASHINGTON<->Franklinton<->5901<->10/1/2001<->0.02<->0.01<->5900<->7/1/2002<->0.035<->0.01<->5/1/2014<->12/31/2099]-
                    [WASHINGTON<->Bogalusa<->5902<->4/1/2008<->0.0333<->0.01<->5900<->7/1/2002<->0.0183<->0.01<->5/1/2014<->12/31/2099]-
                    [WASHINGTON<->Angie<->5903<->9/1/1962<->0.01<->0.01<->5900<->7/1/2002<->0.035<->0.01<->5/1/2014<->12/31/2099]-
                    [WASHINGTON<->Washington Parish Ward 4<->5904<->7/1/2002<->0.01<->0.01<->5900<->7/1/2002<->0.025<->0.01<->5/1/2014<->12/31/2099]-
                    [WASHINGTON<->Varnado<->5905<->12/1/1986<->0.01<->0.02<->5900<->7/1/2002<->0.035<->0.01<->5/1/2014<->12/31/2099]-
                    [WASHINGTON<->Sales Tax District #2<->5906<->1/1/2003<->0.01<->0.02<->5900<->7/1/2002<->0.035<->0.01<->5/1/2014<->12/31/2099]-
                    [WEBSTER<->PARISH ONLY<->none<->none<->none<->none<->6000<->4/1/2005<->0.03<->0.015<->5/1/2014<->12/31/2099]-
                    [WEBSTER<->Minden<->6001<->6/1/2000<->0.02<->0.015<->6000<->4/1/2005<->0.035<->0.015<->5/1/2014<->12/31/2099]-
                    [WEBSTER<->Cotton Valley<->6002<->1/14/1986<->0.01<->0.015<->6000<->4/1/2005<->0.03<->0.015<->5/1/2014<->12/31/2099]-
                    [WEBSTER<->Springhill<->6003<->6/1/1992<->0.025<->0.015<->6000<->4/1/2005<->0.03<->0.015<->5/1/2014<->12/31/2099]-
                    [WEBSTER<->Cullen<->6004<->7/1/1995<->0.025<->0.015<->6000<->4/1/2005<->0.03<->0.015<->5/1/2014<->12/31/2099]-
                    [WEBSTER<->Sarepta<->6005<->6/1/1992<->0.01<->0.015<->6000<->4/1/2005<->0.03<->0.015<->5/1/2014<->12/31/2099]-
                    [WEBSTER<->Sibley<->6006<->1/1/2011<->0.025<->0.015<->6000<->4/1/2005<->0.03<->0.015<->5/1/2014<->12/31/2099]-
                    [WEBSTER<->Dixie Inn<->6007<->1/1/1994<->0.02<->0.015<->6000<->4/1/2005<->0.03<->0.015<->5/1/2014<->12/31/2099]-
                    [WEBSTER<->Dixie Inn Tax Dist #6<->6008<->1/1/1994<->0.02<->0.015<->6000<->4/1/2005<->0.035<->0.015<->5/1/2014<->12/31/2099]-
                    [WEBSTER<->Parish Area Within Dist #6<->6009<->none<->none<->none<->6000<->4/1/2005<->0.035<->0.015<->5/1/2014<->12/31/2099]-
                    [WEST BATON ROUGE<->PARISH ONLY<->none<->none<->none<->none<->6100<->7/1/1999<->0.05<->0.01<->5/1/2014<->12/31/2099]-
                    [WEST CARROLL<->PARISH ONLY<->none<->none<->none<->none<->6200<->5/1/2013<->0.05<->0.01<->5/1/2014<->12/31/2099]-
                    [WEST CARROLL<->Oak Grove<->6201<->4/1/2008<->0.01<->0.01<->6200<->5/1/2013<->0.05<->0.01<->5/1/2014<->12/31/2099]-
                    [WEST FELICIANA<->PARISH ONLY<->none<->none<->none<->none<->6300<->5/1/2013<->0.05<->0.011<->5/1/2014<->12/31/2099]-
                    [WEST FELICIANA<->Town Of St. Francisville<->6301<->7/1/2010<->0.01<->0.011<->6300<->5/1/2013<->0.05<->0.011<->5/1/2014<->12/31/2099]-
                    [WINN<->PARISH ONLY<->none<->none<->none<->none<->6400<->4/1/2004<->0.03<->0.02<->5/1/2014<->12/31/2099]-
                    [WINN<->Winnfield<->6401<->12/1/1983<->0.015<->0.02<->6400<->4/1/2004<->0.03<->0.02<->5/1/2014<->12/31/2099]-";

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addParishesWithCities();

        $this->addTitleFees();
        $this->addCityOffices();
        $this->addPlateTypes();
        $this->addPlateTypesLA();
        $this->addTransactionTypeLA();
        $this->addLATruckWeightFees();

        print('Louisiana Seeded.' . PHP_EOL);
    }

    public function getNormalizedCasing($str)
    {
        $str = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($str))));

        return $str;
    }


    public function addLATruckWeightFees()
    {
        $data = preg_split('/-\s/', $this->la_license_truck_weight_fees);

        foreach ($data as $entry) {
            $entry = preg_replace('/^\[|\]$/', '', trim($entry));

            if ($entry != "") {
                // Process.
                $entry = explode('-', $entry);

                $category_map = [
                    'truck' => 'truck',
                    'truck tractor' => 'truck-tractor',
                    'car' => 'car',
                    'suv' => 'SUV',
                    'van' => 'van'
                ];
                $type_map = [
                    'truck' => 'truck',
                    'truck tractor' => 'truck-tractor',
                    'car' => 'car',
                    'suv' => 'SUV',
                    'van' => 'van'
                ];

                $type = $type_map[$entry[0]];
                $category = $category_map[$entry[0]];
                $begin_weight = str_replace(',', '', $entry[1]);
                $end_weight = str_replace(',', '', $entry[2]);
                $formula = $entry[3];
                $farm_plate = $entry[4];

                print("$type $begin_weight $end_weight $formula" . PHP_EOL);

                $farmPlateID = '';

                $categoryID = DB::table('categories')
                    ->where('name', $category)
                    ->first()
                    ->id;

                $typeID = DB::table('types')
                    ->where('name', $type)
                    ->first()
                    ->id;

                $categoryTypeID = DB::table('categories_types')
                    ->where('category_id', $categoryID)
                    ->where('type_id', $typeID)
                    ->first()
                    ->id;

                if ($farm_plate == 'Farm Plate') {
                    $farmPlateExists = DB::table('plate_types')
                        ->where('name', 'Farm Plate')
                        ->first();

                    if ($farmPlateExists) {
                        $farmPlateID = $farmPlateExists->id;


                    } else {
                        print('Farm Plate does not exist!');
                    }
                } else {

                }

                if ($farmPlateID != "") {
                    $insertArr = [
                        'category_type_id' => $categoryTypeID,
                        'begin_weight' => $begin_weight,
                        'end_weight' => $end_weight,
                        'formula' => $formula,
                        'plate_type_id' => $farmPlateID
                    ];

                    $sql_exists = "
                            SELECT COUNT(*) as count FROM la_license_truck_weight_fees
                            WHERE
                              category_type_id = :category_type_id AND
                              begin_weight = :begin_weight AND
                              end_weight = :end_weight AND
                              formula = :formula AND
                              plate_type_id = :plate_type_id
                    ";

                    $sql_raw = "
                            SELECT COUNT(*) as count FROM la_license_truck_weight_fees
                            WHERE
                              category_type_id = '$categoryTypeID' AND
                              begin_weight = '$begin_weight' AND
                              end_weight = '$end_weight' AND
                              formula = '$formula' AND
                              plate_type_id = '$farmPlateID'
                    ";

                    $exists = DB::select(DB::raw($sql_exists), array(
                        'category_type_id' => $categoryTypeID,
                        'begin_weight' => $begin_weight,
                        'end_weight' => $end_weight,
                        'formula' => $formula,
                        'plate_type_id' => $farmPlateID
                    ));
                } else {
                    $insertArr = [
                        'category_type_id' => $categoryTypeID,
                        'begin_weight' => $begin_weight,
                        'end_weight' => $end_weight,
                        'formula' => $formula
                    ];

                    $sql_exists = "
                            SELECT COUNT(*) as count FROM la_license_truck_weight_fees
                            WHERE
                              category_type_id = :category_type_id AND
                              begin_weight = :begin_weight AND
                              end_weight = :end_weight AND
                              formula = :formula AND
                              plate_type_id IS NULL
                    ";

                    $sql_raw = "
                            SELECT COUNT(*) as count FROM la_license_truck_weight_fees
                            WHERE
                              category_type_id = '$categoryTypeID' AND
                              begin_weight = '$begin_weight' AND
                              end_weight = '$end_weight' AND
                              formula = '$formula' AND
                              plate_type_id IS NULL
                    ";

                    $exists = DB::select(DB::raw($sql_exists), array(
                        'category_type_id' => $categoryTypeID,
                        'begin_weight' => $begin_weight,
                        'end_weight' => $end_weight,
                        'formula' => $formula
                    ));
                }

                if ($exists[0]->count > 0) {
                    // print('Already Inserted.');
                } else {
                    $insert_id = DB::table('la_license_truck_weight_fees')
                        ->insertGetId($insertArr);

                    if ($insert_id) {
                        // print('Inserted Successfully.');
                    }
                }

            }
        }
    }

    public function addTransactionTypeLA()
    {
        $sql = "
            INSERT INTO ttltype_states (ttltype_id, state_id)
            SELECT
              id,
              (SELECT
                id
              FROM
                states
              WHERE `code` = 'LA') AS state_id
            FROM
              ttltypes
            WHERE id NOT IN
              (SELECT
                ttltype_id
              FROM
                ttltype_states)
              AND `name` != 'Title only'
              AND `name` != 'Registration Only'
        ";

        DB::statement($sql);
    }

    public function addPlateTypes()
    {
        $plate_types = $this->plate_types;
        $plate = '';

        if ($plate_types) {
            foreach ($plate_types as $plate) {
                $exists = DB::table('plate_types')
                    ->where('name', $plate)
                    ->first();

                if (!$exists) {
                    $plateID = DB::table('plate_types')
                        ->insertGetId(['name' => $plate]);

                    if ($plateID) {
                        // print('Plate ' . $plate . ' inserted.' . PHP_EOL);
                    }
                } else {
                    // print('Plate ' . $plate . ' already exists.' . PHP_EOL);
                }
            }
        }
    }

    // For LA.
    public function addPlateTypesLA()
    {
        /*$sql = "
            INSERT INTO plate_types_states (plate_type_id, state_id)
            SELECT
              id,
              (SELECT
                id
              FROM
                states
              WHERE `code` = 'LA') AS state_id
            FROM
              plate_types
            WHERE id NOT IN
              (SELECT
                plate_type_id
              FROM
                plate_types_states)
              AND `name` != 'Apportioned Plate'
              AND `name` != 'Motor Bus Plate'
        ";*/

        $sql = "
            SELECT
              id,
              name,
              (SELECT
                id
              FROM
                states
              WHERE `code` = 'LA') AS state_id
            FROM
              plate_types
            WHERE id NOT IN
              (SELECT
                plate_type_id
              FROM
                plate_types_states)
              AND `name` != 'Apportioned Plate'
              AND `name` != 'Motor Bus Plate'
        ";

        $result = DB::select(
            DB::raw($sql)
        );

        $plate_order = [
            'Apportioned Plate ' => 0,
            'Boat Trailer Plate' => 1,
            'Car Plate' => 2,
            'Commercial Plate' => 3,
            'Exempt Plate' => 4,
            'Farm Plate' => 5,
            'Motorcycle Plate' => 6,
            'Motor Home Plate' => 7,
            'NONE' => 8,
            'Permanent Trailer Plate' => 9,
            'Private Bus Plate' => 10,
            'Trailer Plate' => 11,
            'Truck Plate' => 12,
            'Utility Trailer Plate' => 13,
            '1-Yr Farm Plate' => 14,
            '4-Yr Farm Plate' => 15,
            '1-Yr Trailer Plate' => 16,
            '4-Yr Trailer Plate' => 17,
            '1-Yr Commercial Plate' => 18,
            '2-Yr Commercial Plate' => 19
        ];


        foreach($result as $key => $data) {
            $plate_type_id = $data->id;
            $plate_name = $data->name;
            $state_id = $data->state_id;
            $plate_order_value = $plate_order[$plate_name];

            $sql_check = "
                 SELECT
                   COUNT(id) as plate_count
                 FROM
                   plate_types_states
                 WHERE state_id = :state_id
                   AND order_no = :order_no
                   AND plate_type_id = :plate_type_id
            ";

            $plate_type_check = DB::select(DB::raw($sql_check), array(
                'state_id' => $state_id,
                'order_no' => $plate_order_value,
                'plate_type_id' => $plate_type_id,

            ));

            if($plate_type_check[0]->plate_count == 0) {
                $ttlTypes = DB::table('plate_types_states')
                    ->insertGetId([
                        'state_id' => $state_id,
                        'order_no' => $plate_order_value,
                        'plate_type_id' => $plate_type_id
                    ]);

                if(is_numeric($ttlTypes)) {
                    print('Inserted TTL Type states ' . PHP_EOL);
                }
            } else {
                print('Already inserted' . PHP_EOL);
            }
        }
    }

    public function addCityOffices()
    {
        $cities = explode(';', $this->city_offices['cities']);
        $fees = explode(';', $this->city_offices['fees']);
        $timestamps = explode(';', $this->city_offices['timestamps']);
        $length = count($cities);

        $la_service_fee_check = DB::table('fees')
            ->where('name', '=', 'SERVICE_FEE')
            ->first();

        if ($la_service_fee_check) {
            $la_service_fee_id = $la_service_fee_check->id;
        } else {
            $la_service_fee_id = DB::table('fees')
                ->insertGetId(['name' => 'SERVICE_FEE', 'type' => 'fee']);
        }

        $unfounds = [];

        for ($i = 0; $i < $length; $i++) {
            $city = trim($cities[$i]);
            $fee = trim($fees[$i]);

            $sql = "SELECT id FROM cities WHERE LOWER(`name`) LIKE LOWER(:city)";
            $sql_city = "SELECT id FROM cities WHERE LOWER(`name`) LIKE LOWER('%$city%')";

            $city_check = DB::select(DB::raw($sql), array(
                'city' => '%' . $city . '%'
            ));

            if ($city_check) {
                $city_id = $city_check[0]->id;

                $timestamp = explode('-', $timestamps[$i]);
                $start_date = date('Y-m-d H:i:s', strtotime($timestamp[0]));
                $end_date = date('Y-m-d H:i:s', strtotime($timestamp[1]));


                $fee_check = DB::table('cities_fees')
                    ->where('city_id', '=', $city_id)
                    ->where('fee_id', '=', $la_service_fee_id)
                    ->where('start_date', '=', $start_date)
                    ->where('end_date', '=', $end_date)
                    ->first();

                if ($fee_check) {
                    //print("Fee already exists." . PHP_EOL);
                } else {
                    $raw_fee = trim(str_replace('$', '', $fee));

                    $insert_arr = [
                        'city_id' => $city_id,
                        'fee_id' => $la_service_fee_id,
                        'amount' => $raw_fee,
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                    ];

                    $fee_id = DB::table('cities_fees')
                        ->insertGetId($insert_arr);
                }
            } else {
                $unfounds[] = $city;
            }
        }
    }

    public function addParishesWithCities()
    {
        foreach ($this->county_parishes as $county_with_parish) {
            $parish = $county_with_parish['parish'];
            $cities = $county_with_parish['cities'];

            $state_check = DB::table('states')
                ->where('code', '=', 'LA')
                ->first();

            if ($state_check) {
                $state_id = $state_check->id;
            } else {
                $state_id = DB::table('states')
                    ->insertGetId(['code' => 'LA', 'name' => 'Louisiana']);
            }

            $parish_check = DB::table('counties')
                ->where('name', '=', $parish)
                ->where('is_parish', '=', 1)
                ->where('is_parish', '=', 1)
                ->first();

            if ($parish_check != null) {
                $parish_id = $parish_check->id;
            } else {
                $parish_id = DB::table('counties')->insertGetId(
                    ['name' => $parish, 'is_parish' => '1', 'state_id' => $state_id]
                );
            }

            if ($parish_id != null) {
                //print("Parish: " . $parish_id . ' inserted!' . PHP_EOL);

                // Loop and insert city based on parish id.
                foreach ($cities as $city) {
                    $insert_city_data = ['county_id' => $parish_id, 'name' => $city];

                    $parish_city_check = DB::table('cities')
                        ->where('name', '=', $city)
                        ->where('county_id', '=', $parish_id)
                        ->first();

                    if ($parish_city_check != null) {
                        $parish_city_id = $parish_city_check->id;
                    } else {
                        $parish_city_id = DB::table('cities')->insertGetId($insert_city_data);
                    }
                }
            } else {

            }
        }

    }

    // Add all title fees based on category and type.
    public function addTitleFees()
    {
        $louisiana_entries = $this->louisiana_entries;

        foreach ($louisiana_entries as $entry) {
            $category = $entry['category'];
            $type = $entry['type'];
            $state = $entry['state'];
            $fee = $entry['fee'];
            $amount = $entry['amount'];

            $this->addFee($category, $type, $state, $fee, $amount);
        }
    }

    public function addFee($category, $type, $state, $fee, $amount)
    {
        $pre_insert_values = ['category' => $category, 'type' => $type, 'state' => $state, 'fee' => $fee, 'amount' => $amount];

        $pre_category = $pre_insert_values['category'];
        $pre_type = $pre_insert_values['type'];
        $pre_state = $pre_insert_values['state'];
        $pre_fee = $pre_insert_values['fee'];
        $pre_amount = $pre_insert_values['amount'];

        // Get state and fee.
        $state = DB::table('states')
            ->where('code', '=', $state)
            ->first();

        $fee = DB::table('fees')
            ->where('name', '=', $fee)
            ->first();

        if ($fee != null) {
            $fee_id = $fee->id;
        } else {
            // Insert to DB.
            $pre_insert_fee = $pre_insert_values['fee'];

            $fee_id = DB::table('fees')->insertGetId(
                ['name' => $pre_insert_fee, 'type' => 'fee']
            );
        }

        if ($state != null) {
            $state_id = $state->id;
        }

        // Get category and type.
        $category = DB::table('categories')
            ->where('name', '=', $category)
            ->first();

        $type = DB::table('types')
            ->where('name', '=', $type)
            ->first();


        if ($type != null) {
            $type_id = $type->id;
        } else {
            $type_id = DB::table('types')
                ->insertGetId(['name' => $pre_insert_values['type']]);
        }

        if ($category != null) {
            $category_id = $category->id;
        } else {
            $category_id = DB::table('categories')
                ->insertGetId(['name' => $pre_insert_values['category']]);
        }

        if ($category_id && $type_id) {
            $category_type = DB::table('categories_types')
                ->where('category_id', '=', $category_id)
                ->where('type_id', '=', $type_id)
                ->first();

            if ($category_type != null) {
                $category_type_id = $category_type->id;
            } else {
                $category_type_id = DB::table('categories_types')
                    ->insertGetId(['category_id' => $category_id, 'type_id' => $type_id]);
            }
        }

        // Map them in order.
        $vehicle_types = [
            'car' => 0,
            'van' => 1,
            'SUV' => 2,
            'commercial' => 3,
            'truck' => 4,
            'truck-tractor' => 5,
            'private-bus' => 6,
            'off-road-vehicle' => 7,
            'collector-vehicle' => 8,
            'motor-home' => 9,
            'motorcycle' => 10,
            'utility-trailer' => 11,

            'trailer-1y license' => 12,
            'trailer-4y license' => 13,
            'semi-trailer' => 14,

            'trailer' => 15,
            'boat-trailer' => 16
        ];

        $order_no = $vehicle_types[$pre_type];

        if ($fee_id && $state_id && $type_id) {
            // print("Checking FEE ID: $fee_id state ID: $state_id amount: $amount type ID: $type_id order_no: $order_no");
            $title_fee_check = DB::table('fees_states')
                ->where('fee_id', '=', $fee_id)
                ->where('state_id', '=', $state_id)
                ->where('amount', '=', $amount)
                ->where('category_type_id', '=', $category_type_id)
                ->where('order_no', '=', $order_no)
                ->first();

            if ($title_fee_check == null) {
                // Add to DB.
                $new_insert = DB::table('fees_states')->insertGetId(
                    [
                        'state_id' => $state_id,
                        'fee_id' => $fee_id,
                        'amount' => $amount,
                        'category_type_id' => $category_type_id,
                        'order_no' => $order_no
                    ]
                );

                print("Inserted: $pre_category Type: $pre_type State: $pre_state Fee: $pre_fee Amount: $pre_amount" . PHP_EOL);
            } else {
                print("Already Inserted: $pre_category Type: $pre_type State: $pre_state Fee: $pre_fee Amount: $pre_amount" . PHP_EOL);
            }
        } else {
            //print("Missing params..");
        }
    }

    /**
     * Adds static values
     */
    public function addTitleFee()
    {
        $result = [];

        // Get State (LA) and Fee (18.50)
        $LA = DB::table('states')
            ->where('code', '=', 'LA')
            ->first();

        $fee = DB::table('fees')
            ->where('name', '=', 'TITLE_FEE')
            ->first();
        if ($fee != null) {
            $fee_id = $fee->id;
        }

        if ($LA != null) {
            $LA_id = $LA->id;
        }

        // Get category and type ids for passenger.
        $passenger_category = DB::table('categories')
            ->where('name', '=', 'passenger')
            ->first();

        $passenger_type = DB::table('types')
            ->where('name', '=', 'passenger')
            ->first();

        if ($passenger_type != null) {
            $passenger_type_id = $passenger_type->id;
        }

        if ($passenger_category != null) {
            $passenger_category_id = $passenger_category->id;
        }

        if ($passenger_category_id && $passenger_type_id) {
            $category_type = DB::table('categories_types')
                ->where('category_id', '=', $passenger_category_id)
                ->where('type_id', '=', $passenger_type_id)
                ->first();

            if ($category_type != null) {
                $category_type_id = $category_type->id;
            }
        }

        if ($fee_id && $LA_id && $category_type_id) {
            $title_fee_check = DB::table('fees_states')
                ->where('fee_id', '=', $fee_id)
                ->where('state_id', '=', $LA_id)
                ->where('amount', '=', '68.50')
                ->where('category_type_id', '=', $category_type_id)
                ->first();

            if ($title_fee_check == null) {
                // Add to DB.
                $new_insert = DB::table('fees_states')->insertGetId(
                    [
                        'state_id' => $LA_id,
                        'fee_id' => $fee_id,
                        'amount' => '68.50',
                        'category_type_id' => $category_type_id
                    ]
                );
            } else {

            }

        } else {

        }
    }
}