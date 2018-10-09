<?php

namespace Tests\Services\Calculator\SoldierCalculatorTest;

use Tests\Services\Calculator\SoldierCalculatorTest;

class GetDamageTest extends SoldierCalculatorTest
{
    /**
     * Test getDamage method
     *
     * @covers \Services\Calculator\SoldierCalculatorTest::getDamage()
     */
    public function testGetDamage()
    {
        $testExperience = 3;

        $testResult = $this->soldierCalculator->getDamage($testExperience);
        $this->assertInternalType('float', $testResult);
    }
}
