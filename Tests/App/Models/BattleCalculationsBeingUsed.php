<?php

namespace Tests\App\Models;

use App\Models\Soldier;
use PHPUnit\Framework\TestCase;

abstract class BattleCalculationsBeingUsed extends TestCase
{
    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockCalculator(string $calculatorType, string $method): object
    {
        $vehicleCalculator = $this->createMock($calculatorType);
        $vehicleCalculator
            ->expects($this->once())
            ->method($method);

        return $vehicleCalculator;
    }

    /**
     * @param int $quantity
     * @return array
     */
    public function getMockUnits(int $quantity = 3): array
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
        return $this->createMock(Soldier::class);
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown(): void
    {
        gc_collect_cycles();
    }
}
