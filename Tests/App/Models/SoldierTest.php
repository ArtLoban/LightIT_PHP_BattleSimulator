<?php

namespace Tests\App\Models;

use App\Models\Soldier;
use PHPUnit\Framework\TestCase;
use Services\Calculator\SoldierCalculator;

abstract class SoldierTest extends TestCase
{
    /**
     * @var Soldier
     */
    public $soldier;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $mockSoldierCalculator = $this->mockSoldierCalculator();
        $this->soldier = new Soldier($mockSoldierCalculator);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockSoldierCalculator(): object
    {
        return $this->createMock(SoldierCalculator::class);
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown(): void
    {
        $this->soldier = null;
        gc_collect_cycles();
    }
}
