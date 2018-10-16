<?php

namespace Tests\Services\ClassFactory;

use PHPUnit\Framework\TestCase;
use Services\ClassFactory\Factory;

abstract class FactoryTest extends TestCase
{
    /**
     * @var Factory
     */
    public $factory;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->factory = new Factory();
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown(): void
    {
        $this->factory = null;
        gc_collect_cycles();
    }
}
