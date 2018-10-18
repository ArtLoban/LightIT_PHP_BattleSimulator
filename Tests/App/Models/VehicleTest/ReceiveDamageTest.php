<?php

namespace Tests\App\Models\VehicleTest;

use App\Models\Soldier;
use Tests\App\Models\VehicleTest;

class ReceiveDamageTest extends VehicleTest
{
    /**
     * Test receiveDamage method
     *
     * @covers \App\Models\Vehicle::receiveDamage()
     * @dataProvider receiveDamageDataProvider
     */
    public function testReceiveDamage(float $totalDamageValue)
    {
        $mockSoldiers = $this->getMockSoldiers();
        $this->vehicle->addUnit($mockSoldiers);

        $this->vehicle->receiveDamage($totalDamageValue);
    }

    /**
     * @return array
     */
    public function receiveDamageDataProvider():array
    {
        return [
            [3.2],
        ];
    }

    /**
     * @param int $quantity
     * @return array
     */
    public function getMockSoldiers(int $quantity = 3): array
    {
        $units = [];
        for ($i = 0; $i < $quantity; $i++) {
            $units[] = $this->mockSoldier();
        }

        return $units;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockSoldier(): object
    {
        $mockSoldier = $this->createMock(Soldier::class);
        $mockSoldier
            ->expects($this->once())
            ->method('receiveDamage');
        $mockSoldier
            ->expects($this->once())
            ->method('getHealth');

        return $mockSoldier;
    }
}
