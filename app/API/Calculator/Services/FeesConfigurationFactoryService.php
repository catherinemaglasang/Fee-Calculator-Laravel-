<?php

namespace Thirty98\API\Calculator\Services;

use Thirty98\API\Calculator\Utils\Contracts\StateFees\DocumentFeeServiceInterface;
use Thirty98\API\Calculator\Utils\Contracts\StateFees\LicenseFeeServiceInterface;
use Thirty98\API\Calculator\Utils\Contracts\StateFees\OtherFeeServiceInterface;
use Thirty98\API\Calculator\Utils\Contracts\StateFees\TitleFeeServiceInterface;
use Thirty98\API\Calculator\Utils\Contracts\StateFees\SalesTaxServiceInterface;

class FeesConfigurationFactoryService
{
    protected $fee_classes;

    public function setConfig(
        DocumentFeeServiceInterface $document_fees_class,
        TitleFeeServiceInterface $title_fees_class,
        LicenseFeeServiceInterface $license_fees_class,
        OtherFeeServiceInterface $other_fees_class,
        SalesTaxServiceInterface $sales_tax_class
    ) {
        $this->fee_classes = [
            'document_fees' => $document_fees_class,
            'title_fees'    => $title_fees_class,
            'license_fees'  => $license_fees_class,
            'other_fees'    => $other_fees_class,
            'sales_tax'     => $sales_tax_class
        ];
    }

    public function getDocumentFees()
    {
        
    }

    public function getTitleFees()
    {
        return $this->fee_classes['title_fees']->getTitleFees();
    }

    public function getLicenseFees()
    {
        return $this->fee_classes['license_fees']->getLicenseFees();
    }

    public function getOtherFees()
    {
        return $this->fee_classes['other_fees']->getOtherFees();
    }

    public function getSalesTax()
    {
        return $this->fee_classes['sales_tax']->getSalesTax();
    }


}