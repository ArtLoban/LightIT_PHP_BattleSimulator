<?php

namespace Tests\Services\BattleStrategy\Strategies;

use App\Models\Squad;
use PHPUnit\Framework\TestCase;
use Services\BattleStrategy\Strategies\Strongest;
use Services\Sorter\SquadSorter;

class StrongestTest extends TestCase
{
    /**
     * @var Strongest
     */
    public $strongest;

    /**
     * @var array
     */
    public $mockUnits;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->mockUnits = $this->getMockUnitsArray();
        $mockSquadSorter = $this->mockSquadSorter($this->mockUnits);
        $this->strongest = new Strongest($mockSquadSorter);
    }

    /**
     * Test get method
     *
     * @covers \Services\BattleStrategy\Strategies\Strongest::get()
     */
    public function testGet()
    {
        $strongestSquad = $this->strongest->get($this->mockUnits);

        $this->assertInternalType('object', $strongestSquad);
        $this->assertInstanceOf(Squad::class, $strongestSquad);
    }

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

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->strongest = null;
        gc_collect_cycles();
    }
}
