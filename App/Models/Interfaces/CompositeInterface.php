<?php

namespace App\Models\Interfaces;

interface CompositeInterface
{
    public function addUnit($unit);

    public function removeUnit($unit);

}