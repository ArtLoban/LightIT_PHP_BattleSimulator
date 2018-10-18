<?php

namespace Tests\App\Models\SoldierTest;

use App\Models\Soldier;
use PHPUnit\Framework\TestCase;
use Services\Calculator\SoldierCalculator;

class CalculateAttackProbabilityTest extends TestCase
{
    /**
     * Test calculateAttackProbability method
     *
     * @covers \App\Models\Soldier::calculateAttackProbability()
     */
    public function testCalculateAttackProbability()
    {
        $mockSoldierCalculator = $this->mockSoldierCalculator();
        $soldier = new Soldier($mockSoldierCalculator);

        $soldier->calculateAttackProbability();
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockSoldierCalculator(): object
    {
        $soldierCalculator = $this->createMock(SoldierCalculator::class);
        $soldierCalculator
            ->expects($this->once())
            ->method('getAttackProbability');

        return $soldierCalculator;
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown(): void
    {
        gc_collect_cycles();
    }
}
