<?php

namespace Tests\App\Models\SquadTest;

use App\Models\Soldier;
use Tests\App\Models\SquadTest;

class ReceiveDamageTest extends SquadTest
{
    /**
     * Test receiveDamage method
     *
     * @covers \App\Models\Squad::receiveDamage()
     * @dataProvider receiveDamageDataProvider
     */
    public function testReceiveDamage(float $totalDamageValue)
    {
        $mockSoldiers = $this->getMockSoldiers();
        $this->squad->addUnit($mockSoldiers);

        $this->squad->receiveDamage($totalDamageValue);
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

        return $mockSoldier;
    }
}
