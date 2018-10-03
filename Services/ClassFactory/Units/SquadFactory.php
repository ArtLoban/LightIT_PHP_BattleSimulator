<?php

namespace Services\ClassFactory\Units;

use App\Models\Squad;
use Services\ClassFactory\Units\Strategies\SoldierFactory;
use Services\ClassFactory\Units\Strategies\VehicleFactory;

class SquadFactory
{
    /**
     * @var UnitBuildingStrategy
     */
    private $unitStrategy;

    /**
     * @var array
     */
    private $squadTypes = [
        'soldiers' => SoldierFactory::class,
        'vehicles' => VehicleFactory::class
    ];

    /**
     * SquadFactory constructor.
     * @param UnitBuildingStrategy $unitStrategy
     */
    public function __construct(UnitBuildingStrategy $unitStrategy)
    {
        $this->unitStrategy = $unitStrategy;
    }

    /**
     * @return Squad
     */
    private function getSquad(): Squad
    {
        return new Squad();
    }

    /**
     * @param string $squadType
     * @param int $quantity
     * @param int $armyId
     * @param int $squadId
     * @return Squad
     */
    public function create(string $squadType, int $quantity = 3, int $armyId = 1, int $squadId = 1): Squad
    {
        $squad = $this->getSquad();
        $squad->setArmyId($armyId);
        $squad->setSquadId($squadId);
        $squad->addUnit($this->createUnit($squadType, $quantity));

        return $squad;
    }

    /**
     * @param string $squadType
     * @param int $quantity
     * @return array
     */
    public function createUnit(string $squadType, int $quantity = 3): array
    {
        $unitInstance = $this->unitStrategy->create($squadType);
        $units = $unitInstance->create($quantity);

        return $units;
    }
}