<?php

namespace Services\BattleStrategy\Strategies;

use App\Models\Squad;
use Services\BattleStrategy\Contracts\StrategyInterface;

class Random implements StrategyInterface
{
    /**
     * @param array $units
     * @return Squad
     */
    public function get(array $units): Squad
    {
        $randomKey = array_rand($units);
        $randomSquad = $units[$randomKey];

        return $randomSquad;
    }
}
