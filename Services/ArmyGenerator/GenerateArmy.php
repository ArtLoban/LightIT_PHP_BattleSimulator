<?php

namespace Services\ArmyGenerator;

use Services\ClassFactory\ArmyFactory;

class GenerateArmy
{
    /**
     * Example
     * @var array
     */
    private $armiesList = [
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
     * @var array
     */
    private $army = [];

    private $factory;

    /**
     * GenerateArmy constructor.
     */
    public function __construct(/*$configurator*/)
    {
        $this->factory = new ArmyFactory();
        /*$this->configurator = $configurator;*/
    }

    public function generate()
    {
        $armies = [];
        $armyId = 1;
        foreach ($this->armiesList as $list) {
            $armies = $this->factory->create($list, $armyId);
            $armyId++;
        }

        print_r($armies);

        return $armies;
    }


}