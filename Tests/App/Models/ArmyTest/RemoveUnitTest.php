<?php

namespace Tests\App\Models\ArmyTest;

use App\Models\Squad;
use Tests\App\Models\ArmyTest;

class RemoveUnitTest extends ArmyTest
{
    /**
     * Test removeUnit method
     *
     * @covers \App\Models\Army::removeUnit()
     */
    public function testRemoveUnit()
    {
        // Add a Squad instance to $units property
        $mockSquad = $this->mockSquad();
        $this->army->addUnit($mockSquad);

        // Check that $units property contains previously added mockSoldier
        $this->assertContainsOnlyInstancesOf(Squad::class, $this->army->getUnits());

        $this->army->removeUnit($mockSquad);

        $this->assertEmpty($this->army->getUnits());
    }
}
