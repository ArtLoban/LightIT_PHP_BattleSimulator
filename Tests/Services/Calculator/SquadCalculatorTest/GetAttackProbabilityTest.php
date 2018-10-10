<?php

namespace Tests\Services\Calculator\SquadCalculatorTest;

use App\Models\Soldier;
use Tests\Services\Calculator\SquadCalculatorTest;

class GetAttackProbabilityTest extends SquadCalculatorTest
{
    /**
     * Test getAttackProbability method
     *
     * @covers \Services\Calculator\SquadCalculatorTest::getAttackProbability()
     * @dataProvider attackProbabilityDataProvider
     */
    public function testGetAttackProbability(int $unitQuanity, float $unitAttackProbability, float $result)
    {
        $units = $this->unitsMocker->mock(
            $this,
            Soldier::class,
            'calculateAttackProbability',
            $unitQuanity,
            $unitAttackProbability
        );

        $attackProbability = $this->squadCalculator->getAttackProbability($units);
        $this->assertInternalType('float', $attackProbability);
        $this->assertEquals($result, $attackProbability);
    }

    /**
     * @return array
     */
    public function attackProbabilityDataProvider(): array
    {
        return [
            [3, 0.9, 0.9],
            [5, 1.2, 1.2],
        ];
    }
}
