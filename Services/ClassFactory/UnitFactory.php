<?php

namespace Services\ClassFactory;

use App\Models\Army;
use App\Models\Soldier;
use App\Models\Squad;
use App\Models\Vehicle;

class UnitFactory
{
    const ARMY_UNIT = Army::class;
    const SQUAD_UNIT = Squad::class;
    const VEHICLE_UNIT = Vehicle::class;
    const SOLDIER_UNIT = Soldier::class;

    public function createUnit($className)
    {
        return $unit = new $className;
    }

    /*public function createUnits($className, $quantity = null)
    {
        $units = [];

        for ($i = 0; $i < $quantity; $i++) {
            $units[] = new $className;
        }

        return $units;
    }*/

}