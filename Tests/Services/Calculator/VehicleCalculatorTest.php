<?php

namespace Tests\Services\Calculator;

use App\Models\Soldier;
use Mockery;
use PHPUnit\Framework\TestCase;
use Services\Calculator\VehicleCalculator;

abstract class VehicleCalculatorTest extends TestCase
{
    /**
     * @var VehicleCalculator
     */
    public $vehicleCalculator;

    /**
     * @var array
     */
    public $testUnits = 0;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->vehicleCalculator = new VehicleCalculator();
        $this->testUnits = $this->getMockUnitsArray();
    }

    /**
     * Provide an array of Mock units
     *
     * @return array
     */
    public function getMockUnitsArray(): array
    {
        $units = [];
        $quantity = 3;
        for ($i = 0; $i < $quantity; $i++) {
            $units[] = $this->createMock(Soldier::class);
        }

        return $units;
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
