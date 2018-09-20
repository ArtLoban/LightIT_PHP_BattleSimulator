<?php

namespace App\Models;

use App\Models\Interfaces\CompositeInterface;

class Army extends Unit implements CompositeInterface
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
    private $army;

    /**
     * @return mixed
     */
    public function getArmy()
    {
        return $this->army;
    }

    public function calculateAttackProbability(): float
    {
        // TODO: Implement makeAttack() method.
    }

    public function calculateDamage(): float
    {
        // TODO: Implement afflictDamage() method.
    }

    public function addUnit()
    {
        // TODO: Implement addUnit() method.
    }

    public function removeUnit()
    {
        // TODO: Implement removeUnit() method.
    }

}