<?php

namespace App\Models;


use App\Models\Interfaces\CompositeInterface;

class Squad extends Unit implements CompositeInterface
{
    protected $health;
    protected $recharge;

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

    public function addUnit()
    {
        // TODO: Implement addUnit() method.
    }

    public function removeUnit()
    {
        // TODO: Implement removeUnit() method.
    }

    public function calculateAttackProbability(): float
    {
        // TODO: Implement makeAttack() method.
    }

    public function calculateDamage(): float
    {
        // TODO: Implement afflictDamage() method.
    }

    /**
     * @return mixed
     */
    public function getArmy()
    {
        return $this->army;
    }

}