<?php

namespace Tests\Services\BattleStrategy\Strategies;

use App\Models\Squad;
use PHPUnit\Framework\TestCase;
use Services\Sorter\SquadSorter;

abstract class StrateyAbstract extends TestCase
{
    /**
     * @var array
     */
    public $mockUnits;

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockSquadSorter(array $units): object
    {
        $mockSquadSorter = $this->getMockBuilder(SquadSorter::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mockSquadSorter->method('sort')->willReturn($units);

        return $mockSquadSorter;
    }

    /**
     * @param int $quantity
     * @return array
     */
    public function getMockUnitsArray(int $quantity = 3): array
    {
        $units = [];
        for ($i = 0; $i < $quantity; $i++) {
            $units[] = $this->createMock(Squad::class);
        }

        return $units;
    }
}
