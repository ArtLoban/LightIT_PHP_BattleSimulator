<?php

namespace Tests\Services\Calculator\SoldierCalculatorTest;

use Tests\Services\Calculator\SoldierCalculatorTest;

class GetAttackProbabilityTest extends SoldierCalculatorTest
{
    /**
     * Test getAttackProbability method
     *
     * @covers \Services\Calculator\SoldierCalculatorTest::getAttackProbability()
     */
    public function testGetAttackProbability()
    {
        $testHealth = 3;
        $testExperience = 3;

        $testResult = $this->soldierCalculator->getAttackProbability($testHealth, $testExperience);
        $this->assertInternalType('float', $testResult);
    }
}
