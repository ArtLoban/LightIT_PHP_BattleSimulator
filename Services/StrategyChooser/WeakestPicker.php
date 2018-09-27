<?php

namespace Services\StrategyChooser;

use App\Models\Squad;
use Services\BubbleSorter\BubbleSorter;
use Services\ClassFactory\Factory;

class WeakestPicker implements StrategyChooserInterface
{
    /**
     * @var BubbleSorter
     */
    private $sorter;

    /**
     * WeakestPicker constructor.
     */
    public function __construct()
    {
        $factory = new Factory();
        $this->sorter = $factory->create('BubbleSorter');
    }

    /**
     * Determine the weakest Squad unit within an array
     * First sort the array in ascending order, then pick out the first item, with lowest $health property value
     *
     * @param array $units
     * @return Squad
     */
    public function choose(array $units): Squad
    {
        $units = $this->sorter->sort($units);
        $weakestSquad = array_shift($units);

        return $weakestSquad;
    }
}