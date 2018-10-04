<?php

namespace App\Models\Interfaces;

interface BattleInterface
{
    /**
     * @return float
     */
    public function calculateAttackProbability(): float;

    /**
     * @return float
     */
    public function calculateDamage(): float;

    /**
     * @param float $value
     */
    public function receiveDamage(float $value): void;

}