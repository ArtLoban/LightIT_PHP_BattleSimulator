<?php

namespace App\Models\Interfaces;

use App\Models\Unit;

interface CompositeInterface
{
    /**
     * @param $unit
     */
    public function addUnit($unit): void;

    /**
     * @param Unit $unit
     */
    public function removeUnit(Unit $unit): void;

}