<?php

namespace Services\ClassFactory\Units;

use App\Models\Squad;

class SquadFactory
{
    /**
     * @var Squad
     */
    private $squad;

    /**
     * @var array
     */
    private $squadTypes = [
        'soldiers' => SoldierFactory::class,
        'vehicles' => VehicleFactory::class,
    ];

    /**
     * SquadFactory constructor.
     */
    public function __construct()
    {
        $unitFactory = new UnitFactory;
        $this->squad = $unitFactory->create('Squad');
    }

    /**
     * @param string $squadType
     * @param int $quantity
     * @return Squad
     */
    public function create(string $squadType, int $quantity = 3): Squad
    {
        $this->squad->addUnit($this->createUnit($squadType, $quantity));

        return $this->squad;
    }

    /**
     * @param string $squadType
     * @param int $quantity
     * @return array
     */
    public function createUnit(string $squadType, int $quantity = 3): array
    {
        /*if (!array_key_exists($squadType, $this->squadTypes)) {
            throw new Exception("Custom Error: there is no $squadType squad type in the given array");
        }*/

        $unitInstance = new $this->squadTypes[$squadType];
        $units = $unitInstance->create($quantity);

        return $units;
    }
}