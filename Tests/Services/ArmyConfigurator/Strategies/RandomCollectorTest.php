<?php

namespace Tests\Services\ArmyConfigurator\Strategies;


use PHPUnit\Framework\TestCase;
use Services\ArmyConfigurator\Strategies\RandomCollector;

abstract class RandomCollectorTest extends TestCase
{
    /**
     * @var RandomCollector
     */
    public $randomCollector;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->randomCollector = new RandomCollector();
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->randomCollector = null;
        gc_collect_cycles();
    }
}
