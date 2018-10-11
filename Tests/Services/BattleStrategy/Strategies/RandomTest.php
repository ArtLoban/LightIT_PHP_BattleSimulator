<?php

namespace Tests\Services\BattleStrategy\Strategies;

use App\Models\Squad;
use PHPUnit\Framework\TestCase;
use Services\BattleStrategy\Strategies\Random;

class RandomTest extends TestCase
{
    /**
     * @var Random
     */
    public $random;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->random = new Random();
    }

    /**
     * Test get method
     *
     * @param int $unitsQuantity
     * @covers \Services\BattleStrategy\Strategies\Random::get()
     * @dataProvider randomDataProvider
     */
    public function testGet(int $unitsQuantity)
    {
        $units = $this->getMockUnitsArray($unitsQuantity);
        $randomSquad = $this->random->get($units);

        $this->assertInternalType('object', $randomSquad);
        $this->assertInstanceOf(Squad::class, $randomSquad);
    }

    /**
     * @return array
     */
    public function randomDataProvider(): array
    {
        return [
            [2],
            [4],
        ];
    }

    /**
     * @param int $quantity
     * @return array
     */
    public function getMockUnitsArray(int $quantity): array
    {
        $units = [];
        for ($i = 0; $i < $quantity; $i++) {
           $units[] = $this->createMock(Squad::class);
        }

        return $units;
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->random = null;
        gc_collect_cycles();
    }
}
