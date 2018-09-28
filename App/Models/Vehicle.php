<?php

namespace App\Models;

use App\Models\Interfaces\CompositeInterface;

class Vehicle extends Unit implements CompositeInterface
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
     * The number of Units $this instance is composed of.
     * @var array
     */
    protected $units;

    /**
     * @return float
     */
    public function calculateAttackProbability(): float
    {
        $value = 0.5 * (1 + $this->health / 100) * $this->geometricAverage();

        return round($value, 3);
    }

    /**
     * Calculate geometric average of attack probability of all composed Units
     *
     * @return float
     */
    public function geometricAverage(): float
    {
        $mult = 1;
        foreach ($this->units as $unit) {
            $mult *= $unit->calculateAttackProbability();
        }
        $gavg = pow($mult, 1 / count($this->units));

        return round($gavg, 3);
    }

    /**
     * @return float
     */
    public function calculateDamage(): float
    {
        $sumExperience = 0;
        foreach ($this->units as $unit) {
            $sumExperience += $unit->getExperience();
        }
        $value = 0.1 + ($sumExperience / 100);

        return round($value, 2);
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
            if ($key == $randomKey) { continue; }

            $unit->receiveDamage($totalDamageValue * self::REST_UNITS_DAMAGE);
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