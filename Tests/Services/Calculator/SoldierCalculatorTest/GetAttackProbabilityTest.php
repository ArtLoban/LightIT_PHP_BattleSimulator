<?php

namespace Tests\Services\Calculator\SoldierCalculatorTest;

use Tests\Services\Calculator\SoldierCalculatorTest;

class GetAttackProbabilityTest extends SoldierCalculatorTest
{
    /**
     * Test getAttackProbability method
     *
     * @covers \Services\Calculator\SoldierCalculatorTest::getAttackProbability()
     * @dataProvider attackProbabilityDataProvider
     */
    public function testGetAttackProbability(float $unitHealth, int $unitExperience, float $result)
    {
        $attackProbability = $this->soldierCalculator->getAttackProbability($unitHealth, $unitExperience);
        $this->assertInternalType('float', $attackProbability);
        $this->assertEquals($result, $attackProbability);
    }

    /**
     * @return array
     */
    public function attackProbabilityDataProvider(): array
    {
        return [
            [100, 50, 1.0],
            [50, 50, 0.75],
        ];
    }
}
