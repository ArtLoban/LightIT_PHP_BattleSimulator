<?php

namespace Services\BattleStrategy\Strategies;

use App\Models\Squad;
use Services\BattleStrategy\Contracts\StrategyInterface;
use Services\Sorter\SquadSorter;

class Strongest implements StrategyInterface
{
    /**
     * @var SquadSorter
     */
    private $sorter;

    /**
     * Strongest constructor.
     * @param SquadSorter $squadSorter
     */
    public function __construct(SquadSorter $squadSorter)
    {
        $this->sorter = $squadSorter;
    }

    /**
     * Determine the strongest Squad unit within an array
     * First sort the array in ascending order, then pick out the last item, with highest $health property value
     *
     * @param array $units
     * @return Squad
     */
    public function get(array $units): Squad
    {
        $units = $this->sorter->sort($units);
        $strongestSquad = array_pop($units);

        return $strongestSquad;
    }

}