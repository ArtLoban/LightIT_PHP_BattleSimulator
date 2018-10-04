<?php

namespace App\Models;

use App\Models\Interfaces\BattleInterface;
use App\Models\Interfaces\ExperienceInterface;
use App\Models\Interfaces\HealthInterface;
use Services\Calculator\Interfaces\VehicleCalculatorInterface;

class Vehicle extends CompositeUnit implements ExperienceInterface, BattleInterface, HealthInterface
{
    /**
     * Part of damage receiving by the vehicle itself - 60%
     */
    const SELF_DAMAGE_VALUE = 0.6;

    /**
     * Part of damage receiving by a random operator unit - 20%
     */
    const RANDOM_UNIT_DAMAGE = 0.2;

    /**
     * Part of damage receiving by the rest of operators of the vehicle - 20%
     */
    const REST_UNITS_DAMAGE = 0.1;

    /**
     * The number of soldiers required to operate the vehicle
     */
    const VEHICLE_OPERATORS = 3;

    /**
     * Initial health value of this instance (%)
     */
    const INITIAL_HEALTH = 100;

    /**
     * Represents the health of the unit (%)
     * @var int
     */
    private $health;

    /**
     * @var VehicleCalculatorInterface
     */
    private $calculator;

    /**
     * Vehicle constructor.
     * @param VehicleCalculatorInterface $calculator
     */
    public function __construct(VehicleCalculatorInterface $calculator)
    {
        $this->calculator = $calculator;
        $this->health = self::INITIAL_HEALTH;
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

    /**
     * @return float
     */
    public function calculateAttackProbability(): float
    {
        return $this->calculator->getAttackProbability($this->health, $this->units);
    }

    /**
     * @return float
     */
    public function calculateDamage(): float
    {
        return $this->calculator->getDamage($this->units);
    }

    /**
     * Man a Vehicle instance by 3 Solder instances
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
     * Increment the experience of each unit member
     */
    public function incrementExperience(): void
    {
        foreach ($this->units as $unit) {
            $unit->incrementExperience();
        }
    }

    /**
     * @param float $damageValue
     */
    public function receiveDamage(float $totalDamageValue): void
    {
        $vehicleDamage = $this->health - ($totalDamageValue * self::SELF_DAMAGE_VALUE);
        $this->health = round($vehicleDamage);
        $this->distributeDamage($totalDamageValue);

        // Remove composed operators from Vehicle unit if they hove no more health
        $this->dieIfWasted();
    }

    /**
     * Afflict damage on the Vehicle unit operators
     *
     * @param float $totalDamageValue
     */
    private function distributeDamage(float $totalDamageValue): void
    {
        // Afflict 20% of damage on a random unit
        $randomKey = array_rand($this->units);
        $randomUnit = $this->units[$randomKey];
        $randomUnit->receiveDamage($totalDamageValue * self::RANDOM_UNIT_DAMAGE);

        // Afflict 10% of damage to the each other operator (if present)
        foreach ($this->units as $key => $unit) {
            // except the lucky one who got 20% of damage
            if ($key !== $randomKey) {
                $unit->receiveDamage($totalDamageValue * self::REST_UNITS_DAMAGE);
            }
        }
    }

    /**
     * Remove units from Squad if their health value drops sub zero
     *
     * @param Squad $squad
     */
    private function dieIfWasted(): void
    {
        foreach ($this->units as $key => $unit) {
            if ($unit->getHealth() <= 0) {
                $wastedUnit = $this->units[$key];
                $this->removeUnit($wastedUnit);
            }
        }
    }
}
