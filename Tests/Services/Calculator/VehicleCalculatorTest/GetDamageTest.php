<?php

namespace Tests\Services\Calculator\VehicleCalculatorTest;

use Tests\Services\Calculator\VehicleCalculatorTest;

class GetDamageTest extends VehicleCalculatorTest
{
    /**
     * Test getDamage method
     *
     * @covers \Services\Calculator\VehicleCalculatorTest::getDamage()
     */
    public function testGetDamage()
    {
        $testResult = $this->vehicleCalculator->getDamage($this->testUnits);
        $this->assertInternalType('float', $testResult);
    }
}
