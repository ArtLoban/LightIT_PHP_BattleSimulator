<?php

namespace Tests\App\Models\SquadTest;

use App\Models\Soldier;
use Tests\App\Models\SquadTest;

class RemoveUnitTest extends SquadTest
{
    /**
     * Test removeUnit method
     *
     * @covers \App\Models\Squad::removeUnit()
     */
    public function testRemoveUnit()
    {
        // Add a Soldier instance to $units property
        $mockSoldier = $this->mockSoldier();
        $this->squad->addUnit([$mockSoldier]);

        // Check that $units property contains previously added mockSoldier
        $this->assertContainsOnlyInstancesOf(Soldier::class, $this->squad->getUnits());

        $this->squad->removeUnit($mockSoldier);

        $this->assertEmpty($this->squad->getUnits());
    }
}
