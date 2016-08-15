<?php

namespace Thirty98Test\API\Louisiana;

abstract class AbstractTestCase extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        
        $this->setConfig();
    }
    
    /**
     * @test
     */
    public function titleFeeMustBeSixtyEightDollarsAndFifthyCents()
    {
        $this->assertTrue(false);
    }
    
    /**
     * @test
     */
    public function titleCorrectionFeeMustBeSixtyEightDollarsAndFifthyCents()
    {
        $this->assertTrue(false);
    }
    
    /**
     * @test
     */
    public function handlingFeeMustBeEightDollars()
    {
        $this->assertTrue(false);
    }
    
    /**
     * @test
     */
    public function duplicateTitleFeeIsEqualToTheSumOfTitleFeeAndHandlingFee()
    {
        $this->assertTrue(false);
    }
    
    /**
     * @test
     */
    public function licenseTransferFeeMustBeThreeDollars()
    {
        $this->assertTrue(false);
    }
    
    abstract public function setConfig();
}
