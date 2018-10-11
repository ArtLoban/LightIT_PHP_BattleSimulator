<?php

namespace Tests\Services\Calculator;

use PHPUnit\Framework\TestCase;
use Services\Calculator\VehicleCalculator;
use Tests\Utilities\UnitsMocker\UnitsMocker;

abstract class VehicleCalculatorTest extends TestCase
{
    /**
     * @var VehicleCalculator
     */
    public $vehicleCalculator;

    /**
     * @var UnitsMocker
     */
    public $unitsMocker;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->vehicleCalculator = new VehicleCalculator();
        $this->unitsMocker = new UnitsMocker();
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->vehicleCalculator = null;
        gc_collect_cycles();
    }
}
