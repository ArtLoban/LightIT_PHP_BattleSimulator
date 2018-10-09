<?php

namespace Tests\Services\Calculator\SquadCalculatorTest;

use Tests\Services\Calculator\SquadCalculatorTest;

class GetAttackProbabilityTest extends SquadCalculatorTest
{
    /**
     * Test getAttackProbability method
     *
     * @covers \Services\Calculator\SquadCalculatorTest::getAttackProbability()
     */
    public function testGetAttackProbability()
    {
        $testResult = $this->squadCalculator->getAttackProbability($this->testUnits);
        $this->assertInternalType('float', $testResult);
    }
}
