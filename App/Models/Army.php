<?php

namespace App\Models;

use App\Models\Interfaces\CompositeInterface;

class Army extends Unit implements CompositeInterface
{
    /**
     * The number of Units $this instance is composed of
     * @var array
     */
    private $units = [];

    /**
     * Contain represented army's id
     * @var
     */
    private $armyId;

    /**
     * The choice of attack strategy per army
     * @var
     */
    private $strategy;


    /**
     * @param mixed $strategy
     */
    public function setStrategy(string $strategy): void
    {
        $this->strategy = $strategy;
    }

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
        $this->units[] = $unit;
    }

    public function getUnit()
    {
        return $this->units;
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