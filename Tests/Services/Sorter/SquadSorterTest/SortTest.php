<?php

namespace Tests\Services\Sorter\SquadSorterTest;

use App\Models\Squad;
use PHPUnit\Framework\TestCase;
use Services\Sorter\SquadSorter;

class SortTest extends TestCase
{
    /**
     * @var SquadSorter
     */
    public $squadSorter;

    public function setUp(): void
    {
        $this->squadSorter = new SquadSorter();
    }

    /**
     * Test sort method
     *
     * @covers \Services\Sorter\SquadSorter::sort()
     * @dataProvider sortDataProvider
     */
    public function testSort(int $squadsQuantity, float $attackProbabilityValue)
    {
        $squads = $this->getMockSquadsArray($squadsQuantity, $attackProbabilityValue);
        $sortedSquads = $this->squadSorter->sort($squads);

        $this->assertContainsOnlyInstancesOf(Squad::class, $sortedSquads);

        $firstItem = array_shift($sortedSquads);
        $minSquadAttackValue = $firstItem->calculateAttackProbability();
        $lastItem = array_pop($sortedSquads);
        $maxSquadAttackValue = $lastItem->calculateAttackProbability();

        $this->assertGreaterThan($minSquadAttackValue, $maxSquadAttackValue);
    }

    /**
     * @return array
     */
    public function sortDataProvider(): array
    {
        return [
            [3, 4.5],
            [5, 7.5]
        ];
    }

    /**
     * Build Squad mocks with descending attack probability values.
     * Returns shuffled array
     *
     * @param int $quantity
     * @return array
     */
    public function getMockSquadsArray(int $quantity = 3, float $attackProbabilityValue = 5.5): array
    {
        $squads = [];
        for ($i = 0; $i < $quantity; $i++) {
            $mockSquad = $this->getMockBuilder(Squad::class)
            ->disableOriginalConstructor()
            ->getMock();
            $mockSquad->method('calculateAttackProbability')->willReturn($attackProbabilityValue);

            $squads[] = $mockSquad;
            $attackProbabilityValue--;
        }
        shuffle($squads);

        return $squads;
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown(): void
    {
        $this->squadSorter = null;
        gc_collect_cycles();
    }
}
