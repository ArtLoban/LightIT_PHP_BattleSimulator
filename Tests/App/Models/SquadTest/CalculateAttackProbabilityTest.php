<?php

namespace Tests\App\Models\SquadTest;

use App\Models\Squad;
use Services\Calculator\SquadCalculator;
use Tests\App\Models\BattleCalculationsBeingUsed;

class CalculateAttackProbabilityTest extends BattleCalculationsBeingUsed
{
    /**
     * Test calculateAttackProbability method
     *
     * @covers \App\Models\Squad::calculateAttackProbability()
     * @dataProvider calculateAttackProbabilityDataProvider
     */
    public function testCalculateAttackProbability(string $calculatorType, string $methodName)
    {
        $mockCalculator = $this->mockCalculator($calculatorType, $methodName);
        $squad = new Squad($mockCalculator);
        $mockUnits = $this->getMockUnits();
        $squad->addUnit($mockUnits);

        $squad->calculateAttackProbability();
    }

    /**
     * @return array
     */
    public function calculateAttackProbabilityDataProvider(): array
    {
        return [
            [SquadCalculator::class, 'getAttackProbability']
        ];
    }
}