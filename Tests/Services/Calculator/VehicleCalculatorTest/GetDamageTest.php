<?php

namespace Tests\Services\Calculator\VehicleCalculatorTest;

use App\Models\Soldier;
use Tests\Services\Calculator\VehicleCalculatorTest;

class GetDamageTest extends VehicleCalculatorTest
{
    /**
     * Test getDamage method
     *
     * @covers \Services\Calculator\VehicleCalculatorTest::getDamage()
     * @dataProvider damageDataProvider
     */
    public function testGetDamage(int $unitQuanity, int $unitExperience, float $result)
    {
        $units = $this->unitsMocker->mock(
            $this,
            Soldier::class,
            'getExperience',
            $unitQuanity,
            $unitExperience
        );

        $damage = $this->vehicleCalculator->getDamage($units);
        $this->assertInternalType('float', $damage);
        $this->assertEquals($result, $damage);
    }

    /**
     * @return array
     */
    public function damageDataProvider(): array
    {
        return [
            [3, 1, 0.13],
            [5, 2, 0.2],
        ];
    }
}
