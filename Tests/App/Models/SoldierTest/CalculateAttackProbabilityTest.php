<?php

use Tests\App\Models\SoldierTest;

class CalculateAttackProbabilityTest extends SoldierTest
{
    /**
     * Test calculateAttackProbability method
     *
     * @covers \App\Models\Soldier::calculateAttackProbability()
     */
    public function testCalculateAttackProbability()
    {
        // RUN test
        $testResult = $this->mockCalculator->getAttackProbability($this->testHealth, $this->testExperience);

        // Check the expectations
        $this->assertInternalType('float', $testResult);
    }
}
