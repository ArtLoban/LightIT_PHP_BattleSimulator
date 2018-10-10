<?php

namespace Tests\Services\Calculator\SoldierCalculatorTest;

use Tests\Services\Calculator\SoldierCalculatorTest;

class GetDamageTest extends SoldierCalculatorTest
{
    /**
     * Test getDamage method
     *
     * @covers \Services\Calculator\SoldierCalculatorTest::getDamage()
     * @dataProvider damageDataProvider
     */
    public function testGetDamage(int $unitExperience, float $result)
    {
        $damage = $this->soldierCalculator->getDamage($unitExperience);
        $this->assertInternalType('float', $damage);
        $this->assertEquals($result, $damage);
    }

    /**
     * @return array
     */
    public function damageDataProvider(): array
    {
        return [
            [0, 0.05],
            [50, 0.55],
        ];
    }
}
