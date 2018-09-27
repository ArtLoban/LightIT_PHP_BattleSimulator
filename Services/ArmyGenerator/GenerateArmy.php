<?php

namespace Services\ArmyGenerator;

use Services\ClassFactory\Units\ArmyFactory;

class GenerateArmy
{
    /* Required array structure */
    /*private $armiesList = [
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
    ];*/

    /**
     * Transform an initial array with list of required armies into
     *  an array of Army Models composed with squads and units according to the list
     *
     * @param array $armiesList
     * @return array
     */
    public function generate(array $armiesList): array
    {
        $armies = [];
        $armyId = 1;
        foreach ($armiesList as $list) {
            $army = new ArmyFactory();
            $armies[] = $army->create($list, $armyId);
            $armyId++;
        }

        return $armies;
    }

}