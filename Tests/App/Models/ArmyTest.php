<?php

namespace Tests\App\Models;

use App\Models\Army;
use App\Models\Squad;
use PHPUnit\Framework\TestCase;

abstract class ArmyTest extends TestCase
{
    /**
     * @var Army
     */
    public $army;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->army = new Army();
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockSquad(): object
    {
        return $this->createMock(Squad::class);
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown(): void
    {
        $this->army = null;
        gc_collect_cycles();
    }
}
