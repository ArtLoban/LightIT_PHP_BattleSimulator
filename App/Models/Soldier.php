<?php

namespace App\Models;

class Soldier extends Unit
{
     /**
     * Represents the solider experience
     * @var
     */
    protected $experience = 0;

    /**
     * @return int
     */
    public function getExperience(): int
    {
        return $this->experience;
    }

    /**
     * Increments the experience property value
     */
    public function incrementExperience(): void
    {
        $this->experience = ($this->experience == 50) ? 50 : $this->experience + 1;
    }

    /**
     * @return float
     */
    public function calculateAttackProbability(): float
    {
        $value = 0.5 * (1 + $this->health / 100) * mt_rand(50 + $this->experience, 100) / 100;
        return round($value, 3);
    }

    /**
     * @return float
     */
    public function calculateDamage(): float
    {
        $value = 0.05 + $this->experience / 100;
        return round($value, 2);
    }

    /**
     * @param float $damageValue
     */
    public function receiveDamage(float $damageValue): void
    {
        $this->health = $this->health - round($damageValue, 2);
    }
}