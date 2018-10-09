<?php

namespace Tests\Services\Calculator;

use PHPUnit\Framework\TestCase;
use Services\Calculator\SoldierCalculator;

abstract class SoldierCalculatorTest extends TestCase
{
    /**
     * @var SoldierCalculator
     */
    public $soldierCalculator;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->soldierCalculator = new SoldierCalculator();
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->soldierCalculator = null;
        gc_collect_cycles();
    }
}
