<?php

namespace Services\StrategyChooser;

interface StrategyChooserInterface
{
    public function choose(array $units);
}