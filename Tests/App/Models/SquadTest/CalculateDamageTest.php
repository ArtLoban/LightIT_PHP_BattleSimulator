<?php

namespace Tests\App\Models\SquadTest;

use App\Models\Squad;
use Services\Calculator\SquadCalculator;
use Tests\App\Models\BattleCalculationsBeingUsed;

class CalculateDamageTest extends BattleCalculationsBeingUsed
{
    /**
     * Test calculateDamage method
     *
     * @covers \App\Models\Squad::calculateDamage()
     * @dataProvider calculateDamageDataProvider
     */
    public function testCalculateDamage(string $calculatorType, string $methodName)
    {
        $mockCalculator = $this->mockCalculator($calculatorType, $methodName);
        $squad = new Squad($mockCalculator);
        $mockUnits = $this->getMockUnits();
        $squad->addUnit($mockUnits);

        $squad->calculateDamage();
    }

    /**
     * @return array
     */
    public function calculateDamageDataProvider(): array
    {
        return [
            [SquadCalculator::class, 'getDamage']
        ];
    }
}
