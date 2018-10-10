<?php

namespace Tests\Services\Calculator\SquadCalculatorTest;

use App\Models\Soldier;
use Tests\Services\Calculator\SquadCalculatorTest;

class GetDamageTest extends SquadCalculatorTest
{
    /**
     * Test getDamage method
     *
     * @covers \Services\Calculator\SquadCalculatorTest::getDamage()
     * @dataProvider damageDataProvider
     */
    public function testGetDamage(int $unitQuanity, float $unitDamage, float $result)
    {
        $units = $this->unitsMocker->mock(
            $this,
            Soldier::class,
            'calculateDamage',
            $unitQuanity,
            $unitDamage
        );

        $damage = $this->squadCalculator->getDamage($units);
        $this->assertInternalType('float', $damage);
        $this->assertEquals($result, $damage);
    }

    /**
     * @return array
     */
    public function damageDataProvider(): array
    {
        return [
            [3, 0.9, 2.7],
            [2, 1.5, 3.0],
        ];
    }
}
