<?php

namespace Services\StrategyChooser;

use App\Models\Squad;

interface StrategyChooserInterface
{
    public function choose(array $units): Squad;
}