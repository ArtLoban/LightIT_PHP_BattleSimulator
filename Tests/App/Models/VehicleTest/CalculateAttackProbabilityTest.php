<?php

namespace Tests\App\Models\VehicleTest;

use App\Models\Vehicle;
use Tests\App\Models\VehicleTest;

class CalculateAttackProbabilityTest extends VehicleTest
{
    /**
     * Test calculateAttackProbability method
     *
     * @covers \App\Models\Vehicle::calculateAttackProbability()
     */
    public function testCalculateAttackProbability()
    {
        $inputUnits = [];
        $this->mockCalculator
            ->expects($this->once())
            ->method('getAttackProbability')
            ->with($this->testHealth, $inputUnits);

        $vehicle = new Vehicle($this->mockCalculator);
        $vehicle->addUnit($inputUnits);

        $vehicle->calculateAttackProbability();
    }
}
