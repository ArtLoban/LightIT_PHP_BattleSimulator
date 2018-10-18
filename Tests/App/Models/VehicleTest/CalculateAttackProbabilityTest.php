<?php

namespace Tests\App\Models\VehicleTest;

use App\Models\Vehicle;
use Services\Calculator\VehicleCalculator;
use Tests\App\Models\BattleCalculationsBeingUsed;

class CalculateAttackProbabilityTest extends BattleCalculationsBeingUsed
{
    /**
     * Test calculateAttackProbability method
     *
     * @covers \App\Models\Vehicle::calculateAttackProbability()
     * @dataProvider calculateAttackProbabilityDataProvider
     */
    public function testCalculateAttackProbability(string $calculatorType, string $methodName)
    {
        $mockCalculator = $this->mockCalculator($calculatorType, $methodName);
        $vehicle = new Vehicle($mockCalculator);
        $mockUnits = $this->getMockUnits();
        $vehicle->addUnit($mockUnits);

        $vehicle->calculateAttackProbability();
    }

    /**
     * @return array
     */
    public function calculateAttackProbabilityDataProvider(): array
    {
        return [
            [VehicleCalculator::class, 'getAttackProbability']
        ];
    }
}
