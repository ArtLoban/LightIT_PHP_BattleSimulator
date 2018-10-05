<?php

use App\Models\Soldier;
use PHPUnit\Framework\TestCase;
use Services\Calculator\SoldierCalculator;

class CalculateAttackProbabilityTest extends TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    public $calculator;

    /**
     * @var Soldier
     */
    public $soldier;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->calculator = $this->createMock(SoldierCalculator::class);
        $this->soldier = new Soldier($this->calculator);
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        // If you use Mockery in your tests you MUST use this method
        Mockery::close();

        // Clean up the memory taken by your instance of service
        $this->soldier = null;

        // Forces collection of any existing garbage cycles
        gc_collect_cycles();

    }



//    /** @var \PHPUnit_Framework_MockObject_MockObject */
//    public $httpClientMock;
//
//    /** @var DataService */
//    public $dataService;
//
//    /**
//     * {@inheritdoc}
//     */
//    public function setUp()
//    {
//        $this->httpClientMock = $this->createMock(HttpClient::class);
//        $this->dataService = new DataService($this->httpClientMock);
//    }
//
//    // here is should be your test cases for getData method
//
//    /**
//     * {@inheritdoc}
//     */
//    public function tearDown()
//    {
//        // If you use Mockery in your tests you MUST use this method
//        Mockery::close();
//
//        // clean up the memory taken by your instance of service
//        $this->dataService = null;
//
//        // Forces collection of any existing garbage cycles
//        gc_collect_cycles();
//    }

}