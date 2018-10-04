<?php

namespace App\Models;

use App\Models\Interfaces\ArmyInterface;
use App\Models\Interfaces\BattleInterface;
use App\Models\Interfaces\ExperienceInterface;
use Services\Calculator\Interfaces\SquadCalculatorInterface;

class Squad extends CompositeUnit implements ExperienceInterface, BattleInterface, ArmyInterface
{
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
     * @var SquadCalculatorInterface
     */
    private $calculator;

    /**
     * Squad constructor.
     * @param SquadCalculatorInterface $calculator
     */
    public function __construct(SquadCalculatorInterface $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * @param mixed $armyId
     */
    public function setArmyId($armyId): void
    {
        $this->armyId = $armyId;
    }

    /**
     * @return int
     */
    public function getArmyId(): int
    {
        return $this->armyId;
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
     * Remove unit from units property
     * @param $unit
     */
    public function removeUnit($unit): void
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
        return $this->calculator->getAttackProbability($this->units);
    }

    /**
     * @return float
     */
    public function calculateDamage(): float
    {
        return $this->calculator->getDamage($this->units);
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

    /**
     * Increment the experience of each unit member
     */
    public function incrementExperience(): void
    {
        foreach ($this->units as $unit) {
            $unit->incrementExperience();
        }
    }
}
