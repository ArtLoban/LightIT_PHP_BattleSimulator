<?php

namespace Services\ArmyGenerator;

use Services\ClassFactory\UnitFactory;

class GenerateArmy
{
    /**
     * Example
     * @var array
     */
    private $configuration = [
        0 => [
            'strategy' => 'random',
            'squads' => [
                0 => ['soldiers' => 7],
                1 => ['vehicles' => 5],
                2 => ['vehicles' => 9],
                3 => ['soldiers' => 10],
            ],
        ],
        1 => [
            'strategy' => 'weakest',
            'squads' => [
                0 => ['soldiers' => 7],
                1 => ['vehicles' => 5],
                2 => ['vehicles' => 9],
                3 => ['soldiers' => 10],
            ],
        ],
    ];
    /**
     * @var UnitFactory
     */
    private $factory;

    /**
     * @var array
     */
    private $army = [];

    /**
     * GenerateArmy constructor.
     */
    public function __construct(/*$configurator*/)
    {
        $this->factory = new UnitFactory();
        /*$this->configurator = $configurator;*/
    }

    /**
     *
     */
    public function makeArmies()
    {
        for ($i = 0; $i < count($this->configurator); $i++) {
            $army = $this->factory->create(UnitFactory::ARMY_UNIT);
            $army->setArmyId($i+1);
            $army->setStrategy($this->configurator[$i]['strategy']);
            $armyUnit = $this->fillUpArmy($army, $this->configurator[$i]['squads']);

            $this->army = $armyUnit;
        }
    }

    /**
     * @param Army $army
     * @param array $squads
     * @return array
     */
    private function fillUpArmy(Army $army, array $squads): array
    {
        $armyUnit = [];
        foreach ($squads as $unitType => $quantity) {
            $armyUnit[] = $army->addUnit($this->makeSquad($unitType, $quantity));
        }

        return $armyUnit;
    }

    /**
     * @param string $unitType
     * @param int $quantity
     * @return Squad
     */
    private function makeSquad(string $unitType, int $quantity): Squad
    {
        $squad = $this->factory->create(UnitFactory::SQUAD_UNIT);

        for ($i = 0; $i < $quantity; $i++) {

            if ($unitType == 'soldiers') {
                $squad->addUnit($this->makeSoldier());
            } elseif ($unitType == 'vehicles') {
                $squad->addUnit($this->makeVehile());
            }
        }

        return $squad;
    }

    /**
     * @return Vehicle
     */
    private function makeVehile(): Vehicle
    {
        $vehicle = $this->factory->create(UnitFactory::VEHICLE_UNIT);

        $operators = Vehicle::VEHICLE_OPERATORS;

        for ($i = 0; $i < $operators; $i++) {
            $vehicle->addUnit($this->makeSoldier());
        }

        return $vehicle;
    }

    /**
     * @return Soldier
     */
    private function makeSoldier(): Soldier
    {
        return $this->factory->create(UnitFactory::SOLDIER_UNIT);
    }
}