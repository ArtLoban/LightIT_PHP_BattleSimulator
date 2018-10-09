<?php

namespace Tests\App\Models\SoldierTest;

use Tests\App\Models\SoldierTest;

class ReceiveDamageTest extends SoldierTest
{
    /**
     * Test receiveDamage method
     *
     * @covers \App\Models\Soldier::receiveDamage()
     */
    public function testReceiveDamage()
    {
        $testDamageValue = 2.3;

        $this->soldier->receiveDamage($testDamageValue);
        $expectedHealthValue = $this->soldier->getHealth();

        $this->assertEquals(97.7, $expectedHealthValue);
    }

}