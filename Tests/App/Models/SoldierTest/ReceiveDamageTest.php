<?php

namespace Tests\App\Models\SoldierTest;

use Tests\App\Models\SoldierTest;

class ReceiveDamageTest extends SoldierTest
{
    /**
     * Test receiveDamage method
     *
     * @covers \App\Models\Soldier::receiveDamage()
     * @dataProvider receiveDamageDataProvider
     */
    public function testReceiveDamage(float $damageValue, float $roundedDamageValue)
    {
        // Initial health value (100%)
        $soldierHealth = $this->soldier->getHealth();

        $this->soldier->receiveDamage($damageValue);

        // Health value (100% - $roundedDamageValue)
        $reducedSoldierHealth = $this->soldier->getHealth();

        $this->assertEquals($soldierHealth, $reducedSoldierHealth + $roundedDamageValue);
    }

    /**
     * @return array
     */
    public function receiveDamageDataProvider(): array
    {
        return [
            [1.555, 1.56],
            [2.234, 2.23]
        ];
    }
}
