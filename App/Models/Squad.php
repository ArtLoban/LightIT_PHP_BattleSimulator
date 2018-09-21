<?php

namespace App\Models;

use App\Models\Interfaces\CompositeInterface;

class Squad extends Unit implements CompositeInterface
{
    /**
     * The number of Units $this instance is composed of
     * @var array
     */
    protected $units;

    /**
     * Contain represented army's id
     * @var
     */
    private $armyId;

    public function __construct($armyId)
    {
        parent::__construct();
        $this->armyId = $armyId;
    }

    public function addUnits($units)
    {
        $this->units = $units;
    }

    public function removeUnit($unit)
    {
        $this->units = array_udiff($this->units, array($unit), function($a, $b){
            return ($a === $b) ? 0 : 1;
        });
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
        // TODO: Implement afflictDamage() method.
    }

    /**
     * @return mixed
     */
    public function getArmyId()
    {
        return $this->armyId;
    }

}