<?php

namespace Tests\Services\Calculator\SquadCalculatorTest;

use Tests\Services\Calculator\SquadCalculatorTest;

class GetDamageTest extends SquadCalculatorTest
{
    /**
     * Test getDamage method
     *
     * @covers \Services\Calculator\SquadCalculatorTest::getDamage()
     */
    public function testGetDamage()
    {
        $testResult = $this->squadCalculator->getDamage($this->testUnits);
        $this->assertInternalType('float', $testResult);
    }

}