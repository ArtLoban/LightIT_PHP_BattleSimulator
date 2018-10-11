<?php

namespace Tests\Services\Calculator;

use PHPUnit\Framework\TestCase;
use Services\Calculator\SquadCalculator;
use Tests\Utilities\UnitsMocker\UnitsMocker;

abstract class SquadCalculatorTest extends TestCase
{
    /**
     * @var SquadCalculator
     */
    public $squadCalculator;

    /**
     * @var UnitsMocker
     */
    public $unitsMocker;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->squadCalculator = new SquadCalculator();
        $this->unitsMocker = new UnitsMocker();
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown(): void
    {
        $this->squadCalculator = null;
        gc_collect_cycles();
    }
}
