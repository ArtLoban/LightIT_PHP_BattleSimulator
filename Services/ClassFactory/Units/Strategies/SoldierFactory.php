<?php

namespace Services\ClassFactory\Units\Strategies;

use App\Models\Soldier;
use Services\ClassFactory\Units\Contracts\UnitBuildingStrategyInterface;

class SoldierFactory implements UnitBuildingStrategyInterface
{
    /**
     * @return Soldier
     */
    private function getSoldier(): Soldier
    {
        return new Soldier();
    }

    /**
     * Instantiate a number of Soldier objects
     *
     * @param int $quantity
     * @return array
     */
    public function create(int $quantity = 3): array
    {
        $instances = [];
        for ($i = 0; $i < $quantity; $i++) {
            $instances[] = $this->getSoldier();
        }

        return $instances;
    }

}