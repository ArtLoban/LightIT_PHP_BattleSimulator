<?php

namespace App\Models;

use App\Models\Interfaces\UnitInterface;

abstract class Unit implements UnitInterface
{
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
    abstract public function calculateAttackProbability(): float;

    /**
     * @return mixed
     */
    abstract public function calculateDamage(): float;
}