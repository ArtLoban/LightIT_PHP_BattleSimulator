<?php

namespace Tests\Services\Calculator\VehicleCalculatorTest;

use Tests\Services\Calculator\VehicleCalculatorTest;

class GetAttackProbabilityTest extends VehicleCalculatorTest
{
    /**
     * Test getAttackProbability method
     *
     * @covers \Services\Calculator\VehicleCalculator::getAttackProbability()
     */
    public function testGetAttackProbability()
    {
        $testHealth = 33;

        $testResult = $this->vehicleCalculator->getAttackProbability($testHealth, $this->testUnits);
        $this->assertInternalType('float', $testResult);
    }
}
