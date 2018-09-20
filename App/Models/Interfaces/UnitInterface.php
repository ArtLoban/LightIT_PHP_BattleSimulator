<?php

namespace App\Models\Interfaces;

interface UnitInterface
{
    public function calculateAttackProbability(): float;

    public function calculateDamage(): float;
}