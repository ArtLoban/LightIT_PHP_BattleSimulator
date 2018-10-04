<?php

namespace App\Models;

use App\Models\Interfaces\BattleInterface;
use App\Models\Interfaces\ExperienceInterface;
use App\Models\Interfaces\HealthInterface;
use Services\Calculator\Interfaces\SoldierCalculatorInterface;
use Services\Calculator\SoldierCalculator;

class Soldier implements ExperienceInterface, BattleInterface, HealthInterface
{
    /**
     * Initial health value of this instance (%)
     */
    const INITIAL_HEALTH = 100;

     /**
     * Represents the solider experience
     * @var
     */
    private $experience = 0;

    /**
     * Represents the health of the unit (%)
     * @var int
     */
    private $health;

    /**
     * @var SoldierCalculator
     */
    private $calculator;

    /**
     * Soldier constructor.
     * @param SoldierCalculatorInterface $calculator
     */
    public function __construct(SoldierCalculatorInterface $calculator)
    {
        $this->health = self::INITIAL_HEALTH;
        $this->calculator = $calculator;
    }

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
        return $this->calculator->getAttackProbability($this->health, $this->experience);
    }

    /**
     * @return float
     */
    public function calculateDamage(): float
    {
        return $this->calculator->getDamage($this->experience);
    }

    /**
     * @param float $damageValue
     */
    public function receiveDamage(float $damageValue): void
    {
        $this->health = $this->health - round($damageValue, 2);
    }

    /**
     * @return float
     */
    public function getHealth(): float
    {
        return $this->health;
    }

    /**
     * @param int $health
     */
    public function setHealth(int $health): void
    {
        $this->health = $health;
    }
}