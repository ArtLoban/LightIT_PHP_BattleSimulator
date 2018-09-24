<?php

namespace App;

use Services\ArmyGenerator\GenerateArmy;

class SimulatorController
{
    public function start()
    {
        echo PHP_EOL . 'Simulation starts here!' . PHP_EOL. PHP_EOL;



        /* TESTS HERE*/

        /*$a = new ArmyFactory;

        $list = [
            'strategy' => 'random',
            'squads' => [
                0 => ['soldiers' => 7],
                1 => ['vehicles' => 5],
                2 => ['vehicles' => 9],
                3 => ['soldiers' => 10],
            ]];

        $a->create($list, 1);*/

        $g = new GenerateArmy;

        $g->generate();
    }

}