<?php

namespace App\Models\Interfaces;

interface CompositeInterface
{
    /**
     * @param object $unit
     */
    public function addUnit(object $unit): void;

    /**
     * @param object $unit
     */
    public function removeUnit(object $unit): void;

    /**
     * @return array
     */
    public function getUnits(): array;

}