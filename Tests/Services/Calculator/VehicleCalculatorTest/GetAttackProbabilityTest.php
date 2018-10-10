<?php

namespace Tests\Services\Calculator\VehicleCalculatorTest;

use App\Models\Soldier;
use Tests\Services\Calculator\VehicleCalculatorTest;

class GetAttackProbabilityTest extends VehicleCalculatorTest
{
    /**
     * Test getAttackProbability method
     *
     * @covers \Services\Calculator\VehicleCalculator::getAttackProbability()
     * @dataProvider attackProbabilityDataProvider
     */
    public function testGetAttackProbability(int $unitQuanity, float $unitAttackProbability, float $unitHealth, float $result)
    {
        $units = $this->unitsMocker->mock(
            $this,
            Soldier::class,
            'calculateAttackProbability',
            $unitQuanity,
            $unitAttackProbability
        );

        $attackProbability = $this->vehicleCalculator->getAttackProbability($unitHealth, $units);
        $this->assertInternalType('float', $attackProbability);
        $this->assertEquals($result, $attackProbability);
    }

    /**
     * @return array
     */
    public function attackProbabilityDataProvider(): array
    {
        return [
            [3, 0.76, 100.0, 0.76],
            [5, 0.8, 50.0, 0.6],
        ];
    }
}
