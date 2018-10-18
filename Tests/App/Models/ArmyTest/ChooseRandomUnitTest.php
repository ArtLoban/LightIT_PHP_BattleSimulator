<?php

namespace Tests\App\Models\ArmyTest;

use App\Models\Squad;
use Tests\App\Models\ArmyTest;

class ChooseRandomUnitTest extends ArmyTest
{
    /**
     * Test chooseRandomUnit method
     *
     * @covers \App\Models\Army::chooseRandomUnit()
     */
    public function testChooseRandomUnit()
    {
        $this->fillUpArmyWithMockSquads();

        $randomUnit = $this->army->chooseRandomUnit();

        $this->assertNotEmpty($randomUnit);
        $this->assertInternalType('object', $randomUnit);
        $this->assertInstanceOf(Squad::class, $randomUnit);
    }

    /**
     * @param int $quantity
     */
    public function fillUpArmyWithMockSquads(int $quantity = 3): void
    {
        for ($i = 0; $i < $quantity; $i++) {
            $this->army->addUnit($this->mockSquad());
        }
    }
}
