<?php

namespace Services\ArmyGenerator;


use App\Models\Vehicle;
use Services\ClassFactory\UnitFactory;

class GenerateArmy
{
    private $configurator = [
        'armies' => 2,
        'squads' => [
            0 => ['soldiers' => 7],
            1 => ['vehicles' => 5],
            2 => ['vehicles' => 9],
            3 => ['soldiers' => 10],
        ]
    ];

    private $factory;
    private $army = [];

    /**
     * GenerateArmy constructor.
     */
    public function __construct(/*$configurator*/)
    {
        $this->factory = new UnitFactory();
        /*$this->configurator = $configurator;*/
    }

    public function makeArmies()
    {
        for ($i = 1; $i < count($this->configurator) + 1; $i++) {
            $this->factory->createUnit(UnitFactory::ARMY_UNIT);

            // TODO: Make Squads
        }
    }

    private function makeSquad($unitType, $quantity)
    {
        $squad = $this->factory->createUnit(UnitFactory::SQUAD_UNIT);

        for ($i = 0; $i < $quantity; $i++) {

            if ($unitType == 'soldiers') {
                $squad->addUnits($this->makeSoldier());
            } elseif ($unitType == 'vehicles') {
                $squad->addUnits($this->makeVehile());
            }
        }

        return $squad;
    }

    private function makeVehile()
    {
        $vehicle = $this->factory->createUnit(UnitFactory::VEHICLE_UNIT);

        $operators = Vehicle::VEHICLE_OPERATORS;

        for ($i = 0; $i < $operators; $i++) {
            $vehicle->addUnits($this->makeSoldier());
        }

        return $vehicle;
    }

    private function makeSoldier()
    {
        return $this->factory->createUnit(UnitFactory::SOLDIER_UNIT);
    }
}