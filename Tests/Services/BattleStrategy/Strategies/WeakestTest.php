<?php

namespace Tests\Services\BattleStrategy\Strategies;

use App\Models\Squad;
use Services\BattleStrategy\Strategies\Weakest;

class WeakestTest extends StrateyAbstract
{
    /**
     * @var Weakest
     */
    public $weakest;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->mockUnits = $this->getMockUnitsArray();
        $mockSquadSorter = $this->mockSquadSorter($this->mockUnits);
        $this->weakest = new Weakest($mockSquadSorter);
    }

    /**
     * Test get method
     *
     * @covers \Services\BattleStrategy\Strategies\Weakest::get()
     */
    public function testGet()
    {
        $weakestSquad = $this->weakest->get($this->mockUnits);

        $this->assertInternalType('object', $weakestSquad);
        $this->assertInstanceOf(Squad::class, $weakestSquad);
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->weakest = null;
        gc_collect_cycles();
    }
}
