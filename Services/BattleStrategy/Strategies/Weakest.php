<?php

namespace Services\BattleStrategy\Strategies;

use App\Models\Squad;
use Services\BattleStrategy\Contracts\StrategyInterface;
use Services\Sorter\SquadSorter;

class Weakest implements StrategyInterface
{
    /**
     * @var SquadSorter
     */
    private $sorter;

    /**
     * Weakest constructor.
     * @param SquadSorter $squadSorter
     */
    public function __construct(SquadSorter $squadSorter)
    {
        $this->sorter = $squadSorter;
    }

    /**
     * Determine the weakest Squad unit within an array
     * First sort the array in ascending order, then pick out the first item, with lowest $health property value
     *
     * @param array $units
     * @return Squad
     */
    public function get(array $units): Squad
    {
        $units = $this->sorter->sort($units);
        $weakestSquad = array_shift($units);

        return $weakestSquad;
    }
}