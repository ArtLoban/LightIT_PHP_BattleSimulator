<?php

namespace Services\ClassFactory;

use App\Models\Soldier;

class SoldierFactory
{
    /**
     * Instantiate a number of Soldier objects
     *
     * @param int $quantity
     * @return array
     */
    public function createInstance(int $quantity): array
    {
        for ($i = 0; $i < $quantity; $i++) {
            $instances[] = new Soldier();
        }

        return $instances;
    }

}