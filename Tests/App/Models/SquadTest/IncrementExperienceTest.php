<?php

namespace Tests\App\Models\SquadTest;

use App\Models\Soldier;
use Tests\App\Models\SquadTest;

class IncrementExperienceTest extends SquadTest
{
    /**
     * Test incrementExperience method
     *
     * @covers \App\Models\Squad::incrementExperience()
     */
    public function testIncrementExperience()
    {
        $mockSoldier = $this->mockSoldier();
        $this->squad->addUnit([$mockSoldier]);

        $this->squad->incrementExperience();
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
