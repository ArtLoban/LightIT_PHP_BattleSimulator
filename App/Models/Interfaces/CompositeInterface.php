<?php

namespace App\Models\Interfaces;

interface CompositeInterface
{
    public function addUnits($units);

    public function removeUnit($unit);

}