<?php

namespace App\Models;

use App\Models\Interfaces\CompositeInterface;

class Vehicle extends Unit implements CompositeInterface
{
    /**
     * The number of soldiers required to operate the vehicle
     */
    const VEHICLE_OPERATORS = 3;

    /**
     * The number of Units $this instance is composed of.
     * @var array
     */
    protected $units;

    public function __construct()
    {
        parent::__construct();
    }

    public function calculateAttackProbability(): float
    {
        $value = 0.5 * (1 + $this->health / 100) * $this->geometricAverage();

        return $value;
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

        return $gavg;
    }

    public function calculateDamage(): float
    {
        $sumExperience = 0;
        foreach ($this->units as $unit) {
            $sumExperience += $unit->getExperience();
        }

        $value = 0.1 + ($sumExperience / 100);
        return $value;
    }

    /**
     * Man a Vehicle instance by 3 Solder instances
     */
    public function addUnit($unit)
    {
        $this->units = $unit;
//        $this->units = $this->soldierFactory->createInstance(self::VEHICLE_OPERATORS);
    }

    public function removeUnit($unit)
    {
        $this->units = array_udiff($this->units, array($unit), function($a, $b){
            return ($a === $b) ? 0 : 1;
        });
    }

}