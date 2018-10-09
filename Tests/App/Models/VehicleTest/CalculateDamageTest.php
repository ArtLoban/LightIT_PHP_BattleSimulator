<?php

namespace Tests\App\Models\VehicleTest;

use App\Models\Vehicle;
use Tests\App\Models\VehicleTest;

class CalculateDamageTest extends VehicleTest
{
    /**
     * Test calculateDamage method
     *
     * @covers \App\Models\Vehicle::calculateDamage
     */
    public function testCalculateDamage()
    {
        $inputUnits = [];
        $this->mockCalculator
            ->expects($this->once())
            ->method('getDamage')
            ->with($this->equalTo($inputUnits));

        $vehicle = new Vehicle($this->mockCalculator);
        $vehicle->addUnit($inputUnits);

        $vehicle->calculateDamage();
    }
}
