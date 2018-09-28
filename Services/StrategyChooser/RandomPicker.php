<?php

namespace Services\StrategyChooser;

use App\Models\Squad;

class RandomPicker implements StrategyChooserInterface
{
    /**
     * @param array $units
     * @return Squad
     */
    public function choose(array $units): Squad
    {
        $randomKey = array_rand($units);
        $randomSquad = $units[$randomKey];

        return $randomSquad;
    }
}