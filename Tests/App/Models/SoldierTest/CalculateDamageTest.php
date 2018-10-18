<?php

namespace Tests\App\Models\SoldierTest;

use App\Models\Soldier;
use PHPUnit\Framework\TestCase;
use Services\Calculator\SoldierCalculator;

class CalculateDamageTest extends TestCase
{
    /**
     * Test calculateDamage method
     *
     * @covers \App\Models\Soldier::calculateDamage()
     */
    public function testCalculateDamage()
    {
        $mockSoldierCalculator = $this->mockSoldierCalculator();
        $soldier = new Soldier($mockSoldierCalculator);

        $soldier->calculateDamage();
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockSoldierCalculator(): object
    {
        $soldierCalculator = $this->createMock(SoldierCalculator::class);
        $soldierCalculator
            ->expects($this->once())
            ->method('getDamage');

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