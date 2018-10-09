<?php

namespace Tests\App\Models;

use PHPUnit\Framework\TestCase;
use Services\Calculator\VehicleCalculator;

abstract class VehicleTest extends TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    public $mockCalculator;

    /**
     * @var int
     */
    public $testHealth = 33;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->mockCalculator = $this->createMock(VehicleCalculator::class);
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        // Forces collection of any existing garbage cycles
        gc_collect_cycles();
    }
}
