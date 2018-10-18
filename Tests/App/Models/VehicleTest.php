<?php

namespace Tests\App\Models;

use App\Models\Soldier;
use App\Models\Vehicle;
use PHPUnit\Framework\TestCase;
use Services\Calculator\VehicleCalculator;

abstract class VehicleTest extends TestCase
{
    /**
     * @var Vehicle
     */
    public $vehicle;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $mockVehicleCalculator = $this->mockVehicleCalculator();
        $this->vehicle = new Vehicle($mockVehicleCalculator);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockVehicleCalculator(): object
    {
        return $this->createMock(VehicleCalculator::class);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockSoldier(): object
    {
        return $this->createMock(Soldier::class);
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown(): void
    {
        $this->vehicle = null;
        gc_collect_cycles();
    }
}
