<?php

namespace App\Models\Interfaces;

use App\Models\Unit;

interface CompositeInterface
{
    public function addUnit($unit);

    public function removeUnit(Unit $unit);

}