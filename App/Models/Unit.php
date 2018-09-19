<?php

namespace App\Models;

use App\Models\Interfaces\UnitInterface;

abstract class Unit implements UnitInterface
{
    /**
     * @return mixed
     */
    abstract public function makeAttack();

    /**
     * @return mixed
     */
    abstract public function afflictDamage();
}