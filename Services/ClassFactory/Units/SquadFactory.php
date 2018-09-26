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
        $this->squad = new Squad();
    }

    /**
     * @param string $squadType
     * @param int $quantity
     * @return Squad
     */
    public function create(string $squadType, int $quantity): Squad
    {
        $this->squad->addUnit($this->createUnit($squadType, $quantity));
        return $this->squad;
    }

    /**
     * @param string $squadType
     * @param int $quantity
     * @return array
     */
    public function createUnit(string $squadType, int $quantity): array
    {
        foreach ($this->squadTypes as $unitName => $unitFactory) {
            if ($unitName === $squadType) {
                $unit = new $unitFactory;
            }
        }
        $units = $unit->create($quantity);
        return $units;
    }
}