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
     * @param $squadType
     * @param $quantity
     * @return Squad
     */
    public function create($squadType, $quantity)
    {
        $this->squad->addUnit($this->createUnit($squadType, $quantity));
        return $this->squad;
    }

    /**
     * @param $squadType
     * @param $quantity
     * @return mixed
     */
    public function createUnit($squadType, $quantity)
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