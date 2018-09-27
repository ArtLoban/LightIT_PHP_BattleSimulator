<?php

namespace Services\StrategyChooser;

use App\Models\Squad;
use Services\BubbleSorter\BubbleSorter;
use Services\ClassFactory\Factory;

class StrongestPicker implements StrategyChooserInterface
{
    /**
     * @var BubbleSorter
     */
    private $sorter;

    /**
     * StrongestPicker constructor.
     */
    public function __construct()
    {
        $factory = new Factory();
        $this->sorter = $factory->create('BubbleSorter');
    }

    /**
     * Determine the strongest Squad unit within an array
     * First sort the array in ascending order, then pick out the last item, with highest $health property value
     *
     * @param array $units
     * @return Squad
     */
    public function choose(array $units): Squad
    {
        $units = $this->sorter->sort($units);
        $strongestSquad = array_pop($units);

        return $strongestSquad;
    }
}