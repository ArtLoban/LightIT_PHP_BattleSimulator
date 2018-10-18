<?php

namespace Tests\App\Models\VehicleTest;

use App\Models\Vehicle;
use Services\Calculator\VehicleCalculator;
use Tests\App\Models\BattleCalculationsBeingUsed;

class CalculateDamageTest extends BattleCalculationsBeingUsed
{
    /**
     * Test calculateDamage method
     *
     * @covers \App\Models\Vehicle::calculateDamage()
     * @dataProvider calculateDamageDataProvider
     */
    public function testCalculateDamage(string $calculatorType, string $methodName)
    {
        $mockCalculator = $this->mockCalculator($calculatorType, $methodName);
        $vehicle = new Vehicle($mockCalculator);
        $mockUnits = $this->getMockUnits();
        $vehicle->addUnit($mockUnits);

        $vehicle->calculateDamage();
    }

    /**
     * @return array
     */
    public function calculateDamageDataProvider(): array
    {
        return [
            [VehicleCalculator::class, 'getDamage']
        ];
    }
}
