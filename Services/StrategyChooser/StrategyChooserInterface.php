<?php

namespace Services\StrategyChooser;

use App\Models\Squad;

interface StrategyChooserInterface
{
    /**
     * @param array $units
     * @return Squad
     */
    public function choose(array $units): Squad;
}