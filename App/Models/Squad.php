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

    /**
     * Contain represented army's id
     * @var
     */
    private $armyId;

    /**
     * Contain represented squad's id
     * @var
     */
    private $squadId;

    /**
     * @param mixed $armyId
     */
    public function setArmyId($armyId): void
    {
        $this->armyId = $armyId;
    }

    /**
     * @param mixed $squadId
     */
    public function setSquadId($squadId): void
    {
        $this->squadId = $squadId;
    }

    /**
     * @return int
     */
    public function getArmyId(): int
    {
        return $this->armyId;
    }

    /**
     * @return int
     */
    public function getSquadId(): int
    {
        return $this->squadId;
    }

    /**
     * @param $unit
     */
    public function addUnit($unit): void
    {
        $this->units = $unit;
    }

    /**
     * @return array
     */
    public function getUnits(): array
    {
        return $this->units;
    }

    /**
     * Remove Unit from units[] property
     * @param Unit $unit
     */
    public function removeUnit(Unit $unit): void
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

        return round($value, 3);
    }

    /**
     * @return float
     */
    public function calculateDamage(): float
    {
        $sum = 0;
        foreach ($this->units as $unit) {
            $sum += $unit->calculateDamage();
        }

        return round($sum, 2);
    }

    /**
     * Increment the experience of each unit member
     */
    public function incrementExperience(): void
    {
        foreach ($this->units as $unit) {
            $unit->incrementExperience();
        }
    }

    /**
     * Distribute the received damage equally to each Squad unit member
     *
     * @param float $damageValue
     */
    public function receiveDamage(float $totalDamageValue): void
    {
        $unitsQuantity = count($this->units);
        $equalDamagePart = $totalDamageValue / $unitsQuantity;

        foreach ($this->units as $unit) {
            $unit->receiveDamage($equalDamagePart);
        }
    }

}