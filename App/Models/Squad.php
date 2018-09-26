<?php

namespace App\Models;

use App\Models\Interfaces\CompositeInterface;

class Squad extends Unit implements CompositeInterface
{
    /**
     * The number of Units $this instance is composed of
     * @var array
     */
    protected $units = [];

    private $armyId;

    /**
     * @return int
     */
    public function getArmyId(): int
    {
        return $this->armyId;
    }

    /**
     * @param int $armyId
     */
    public function setArmyId(int $armyId)
    {
        $this->armyId = $armyId;
    }

    public function addUnit($unit)
    {
        $this->units = $unit;
    }

    /**
     * Remove Unit from units[] property
     * @param Unit $unit
     */
    public function removeUnit(Unit $unit)
    {
        foreach ($this->units as $key => $composedUnit) {
            if ($composedUnit === $unit) {
                unset($this->units[$key]);
            }
        }
    }

    /**
     * Calculate geometric average of the attack success probability of each unit
     *
     * @return float
     */
    public function calculateAttackProbability(): float
    {
        $mult = 1;
        foreach ($this->units as $unit) {
            $mult *= $unit->calculateAttackProbability();
        }

        $value = pow($mult, 1 / count($this->units));

        return $value;
    }

    public function calculateDamage(): float
    {
        $sum = 0;
        foreach ($this->units as $unit) {
            $sum += $unit->calculateAttackProbability();
        }

        return $sum;
    }
}