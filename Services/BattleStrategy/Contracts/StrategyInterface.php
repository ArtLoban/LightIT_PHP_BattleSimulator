<?php

namespace Services\BattleStrategy\Contracts;

use App\Models\Squad;

interface StrategyInterface
{
    /**
     * @param array $units
     * @return Squad
     */
    public function get(array $units): Squad;
}