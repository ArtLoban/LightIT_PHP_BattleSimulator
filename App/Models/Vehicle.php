<?php

namespace App\Models;

use App\Models\Interfaces\CompositeInterface;
use Services\Factory\SoldierFactory;

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
    public $units;

    /**
     * @var SoldierFactory
     */
    private $soldierFactory;

    public function __construct()
    {
        parent::__construct();
        $this->soldierFactory = new SoldierFactory();
        $this->addUnit();
//        $this->recharge = $this->getRecharge();
    }

    public function calculateAttackProbability(): float
    {
        $value = 0.5 * (1 + $this->health / 100) * $this->geometricAverage();

        return $value;
    }

    public function geometricAverage()
    {
        
    }

    public function calculateDamage(): float
    {
        // TODO: Implement afflictDamage() method.
    }

    /**
     * Man a Vehicle instance by 3 Solder instances
     */
    public function addUnit()
    {
        $this->units = $this->soldierFactory->createInstance(self::VEHICLE_OPERATORS);
    }

    public function removeUnit()
    {
        // TODO: Implement removeUnit() method.
    }

}