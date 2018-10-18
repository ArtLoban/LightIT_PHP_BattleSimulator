<?php

namespace Tests\App\Models\VehicleTest;

use App\Models\Soldier;
use Tests\App\Models\VehicleTest;

class IncrementExperienceTest extends VehicleTest
{
    /**
     * Test incrementExperience method
     *
     * @covers \App\Models\Vehicle::incrementExperience()
     */
    public function testIncrementExperience()
    {
        $mockSoldier = $this->mockSoldier();
        $this->vehicle->addUnit([$mockSoldier]);

        $this->vehicle->incrementExperience();
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockSoldier(): object
    {
        $mockSoldier = $this->createMock(Soldier::class);
        $mockSoldier
            ->expects($this->once())
            ->method('incrementExperience');

        return $mockSoldier;
    }
}
