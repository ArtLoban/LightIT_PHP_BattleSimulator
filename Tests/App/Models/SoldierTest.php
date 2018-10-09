<?php

namespace Tests\App\Models;

use App\Models\Soldier;
use Mockery;
use PHPUnit\Framework\TestCase;
use Services\Calculator\SoldierCalculator;

abstract class SoldierTest extends TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    public $mockCalculator;

    /**
     * @var Soldier
     */
    public $soldier;

    /**
     * @var int
     */
    public $testHealth = 33;

    /**
     * @var int
     */
    public $testExperience = 33;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->mockCalculator = $this->createMock(SoldierCalculator::class);
        $this->soldier = new Soldier($this->mockCalculator);
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        // Clean up the memory taken by your instance of service
        $this->soldier = null;

        // Forces collection of any existing garbage cycles
        gc_collect_cycles();
    }
}
