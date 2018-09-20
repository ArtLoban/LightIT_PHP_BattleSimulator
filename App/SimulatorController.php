<?php

namespace App;


use App\Models\Soldier;
use App\Models\Vehicle;
use Services\Factory\SoldierFactory;

class SimulatorController
{
    public function start()
    {
        echo 'Simulation starts here!' . PHP_EOL;

//        $v = new Vehicle();
//
//        $v = $v->units[0]->calculateAttackProbability();
//
//        $s = new Soldier();
//        $s = $s->calculateAttackProbability();
//        print_r($s);
//        print_r($v);
    }

}