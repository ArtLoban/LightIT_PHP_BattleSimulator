<?php

namespace App\Models;

use App\Models\Interfaces\CompositeInterface;

class Army extends Unit implements CompositeInterface
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

    /**
     * @return mixed
     */
    public function getArmy()
    {
        return $this->armyId;
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

    public function calculateAttackProbability(): float
    {
        // TODO: Implement makeAttack() method.
    }

    public function calculateDamage(): float
    {
        // TODO: Implement afflictDamage() method.
    }

}