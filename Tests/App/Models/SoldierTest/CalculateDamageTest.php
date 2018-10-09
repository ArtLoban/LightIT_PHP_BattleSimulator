<?php

namespace Tests\App\Models\SoldierTest;

use Tests\App\Models\SoldierTest;

class CalculateDamageTest extends SoldierTest
{
    /**
     * Test calculateDamage method
     *
     * @covers \App\Models\Soldier::calculateDamage()
     */
    public function testCalculateDamage()
    {
        $testResult = $this->soldier->calculateDamage();
        $this->assertInternalType('float', $testResult);
    }
}
