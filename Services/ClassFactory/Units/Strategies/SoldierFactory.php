<?php

namespace Services\ClassFactory\Units\Strategies;

use App\Models\Soldier;
use Services\ClassFactory\Factory;
use Services\ClassFactory\Units\Contracts\UnitBuildingStrategyInterface;

class SoldierFactory implements UnitBuildingStrategyInterface
{
    /**
     * @var Factory
     */
    private $container;

    /**
     * SoldierFactory constructor.
     * @param Factory $container
     */
    public function __construct(Factory $container)
    {
        $this->container = $container;
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

    /**
     * @return Soldier
     */
    private function getSoldier(): Soldier
    {
        return $this->container->create(Soldier::class);
    }
}
