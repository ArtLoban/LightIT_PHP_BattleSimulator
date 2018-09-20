<?php

namespace App\Models;

class Soldier extends Unit
{
     /**
     * Represents the solider experience
     * @var
     */
    protected $experience = 0;

    public function __construct()
    {
        parent::__construct();
        $this->recharge = $this->generateRechargeValue();
    }

    /**
     * Increments the experience property value
     */
    public function incrementExperience(): int
    {
        $this->experience = ($this->experience == 50) ? $this->experience = 50 : $this->experience++;
    }

    /**
     * Generates a random value for the recharge property
     * @return int
     */
    public function generateRechargeValue(): int
    {
        return mt_rand(100, 2000);
    }

    public function calculateAttackProbability(): float
    {
        $value = 0.5 * (1 + $this->health / 100) * mt_rand(50 + $this->experience, 100) / 100;
        return $value;
    }

    public function calculateDamage(): float
    {
        $value = 0.05 + $this->experience / 100;
        return $value;
    }

}