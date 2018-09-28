<?php

namespace App\Models;

use App\Models\Interfaces\UnitInterface;

abstract class Unit implements UnitInterface
{
    /*const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;*/

    /**
     * Initial health value of an Unit instance (%)
     */
    const INITIAL_HEALTH = 100;

    /**
     * Represents the health of the unit (%)
     *
     * @var float
     */
    protected $health;

    /**
     * Represents the number of ms required to recharge the unit for an attack (ms)
     * @var
     */
    /*protected $recharge;*/

    /**
     * Unit activity status
     * @var
     */
//    protected $status;

    /**
     * Unit constructor.
     * @param $health
     * @param $status
     */
    public function __construct()
    {
        $this->health = self::INITIAL_HEALTH;
//        $this->status = self::STATUS_ACTIVE;
    }

    /**
     * @return mixed
     */
    public function getHealth(): float
    {
        return $this->health;
    }

    /**
     * @param mixed $health
     */
    public function setHealth(int $health): void
    {
        $this->health = $health;
    }

    /**
     * @return mixed
     */
    /*public function getRecharge(): int
    {
        return $this->recharge;
    }*/

    /**
     * @return mixed
     */
    abstract public function calculateAttackProbability(): float;

    /**
     * @return mixed
     */
    abstract public function calculateDamage(): float;
}