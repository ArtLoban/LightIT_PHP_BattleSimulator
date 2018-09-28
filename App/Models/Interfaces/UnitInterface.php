<?php

namespace App\Models\Interfaces;

interface UnitInterface
{
    /**
     * @return float
     */
    public function calculateAttackProbability(): float;

    /**
     * @return float
     */
    public function calculateDamage(): float;
}