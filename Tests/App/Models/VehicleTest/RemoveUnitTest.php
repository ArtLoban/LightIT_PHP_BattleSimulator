<?php

namespace Tests\App\Models\VehicleTest;

use App\Models\Soldier;
use Tests\App\Models\VehicleTest;

class RemoveUnitTest extends VehicleTest
{
    /**
     * Test removeUnit method
     *
     * @covers \App\Models\Vehicle::removeUnit()
     */
    public function testRemoveUnit()
    {
        // Add a Soldier instance to $units property
        $mockSoldier = $this->mockSoldier();
        $this->vehicle->addUnit([$mockSoldier]);

        // Check that $units property contains previously added mockSoldier
        $this->assertContainsOnlyInstancesOf(Soldier::class, $this->vehicle->getUnits());

        $this->vehicle->removeUnit($mockSoldier);

        $this->assertEmpty($this->vehicle->getUnits());
    }
}
