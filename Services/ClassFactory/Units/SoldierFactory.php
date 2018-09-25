<?php

namespace Services\ClassFactory\Units;

use App\Models\Soldier;

class SoldierFactory
{
    /**
     * Instantiate a number of Soldier objects
     *
     * @param int $quantity
     * @return array
     */
    public function create(int $quantity): array
    {
        $instances = [];
        for ($i = 0; $i < $quantity; $i++) {
            $instances[] = new Soldier();
        }

        return $instances;
    }

}