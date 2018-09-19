<?php

namespace App\Models\Interfaces;

interface UnitInterface
{
    public function addUnit();

    public function removeUnit();

    public function makeAttack();

    public function afflictDamage();
}