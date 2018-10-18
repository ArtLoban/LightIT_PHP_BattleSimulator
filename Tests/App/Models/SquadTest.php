<?php

namespace Tests\App\Models;

use App\Models\Soldier;
use App\Models\Squad;
use PHPUnit\Framework\TestCase;
use Services\Calculator\SquadCalculator;

abstract class SquadTest extends TestCase
{
    /**
     * @var Squad
     */
    public $squad;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $mockSquadCalculator = $this->mockSquadCalculator();
        $this->squad = new Squad($mockSquadCalculator);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockSquadCalculator(): object
    {
        return $this->createMock(SquadCalculator::class);
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
        $this->squad = null;
        gc_collect_cycles();
    }
}
