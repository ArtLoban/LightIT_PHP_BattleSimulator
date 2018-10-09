<?php

namespace Tests\Services\Calculator;

use App\Models\Soldier;
use Mockery;
use PHPUnit\Framework\TestCase;
use Services\Calculator\SquadCalculator;

abstract class SquadCalculatorTest extends TestCase
{
    /**
     * @var SquadCalculator
     */
    public $squadCalculator;

    /**
     * @var array
     */
    public $testUnits;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->squadCalculator = new SquadCalculator();
        $this->testUnits = $this->getMockUnitsArray();
    }

    /**
     * Provide an array of Mock units
     *
     * @return array
     */
    public function getMockUnitsArray(): array
    {
        $units = [];
        $quantity = 3;
        for ($i = 0; $i < $quantity; $i++) {
            $units[] = $this->createMock(Soldier::class);
        }

        return $units;
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
