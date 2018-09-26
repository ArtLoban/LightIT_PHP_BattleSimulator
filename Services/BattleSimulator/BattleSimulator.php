<?php

namespace Services\BattleSimulator;

use App\Models\Squad;
use Services\ClassFactory\Factory;

class BattleSimulator
{
    /**
     * @var array
     */
    private $strategies = [
        'random' => 'RandomPicker',
        'weakest' => 'WeakestPicker',
        'strongest' => 'StrongestPicker',
    ];

    /**
     * @var
     */
    private $factory;

    /**
     * BattleSimulator constructor.
     */
    public function __construct()
    {
        $this->factory = new Factory();
    }

    /**
     * Manage the simulation.
     * If there are more then one Army left, initiate the next battle round.
     * If there only one Army unit left it becomes a winner of battle
     * @param array $armies
     */
    public function simulate(array $armies)
    {
        echo PHP_EOL . '++! BATTLE starts here! !++' . PHP_EOL. PHP_EOL;

        if (count($armies) > 1) {
            $this->startIteration($armies);
        } else {
            echo $this->determineWiner($armies);
        }
    }

    /**
     * @param array $armies
     * @return string
     */
    private function determineWiner(array $armies): string
    {
        $winer = array_shift($armies);
        return 'Winner is Army-'. $winer->getArmyId() . PHP_EOL;
    }

    /**
     * Arrange one cycle of the battle .
     * One Squad of each Army makes one attacking attempt
     *
     * @param array $armies
     */
    private function startIteration(array $armies)
    {
        $rivals = [];
        foreach ($armies as $armyKey => $army) {
            // Determine attacking Squad
            $attackingSquad = $army->chooseRandomUnit();
            $rivals['attacker'] = $attackingSquad;

            // Determine defending Squad
            $allSquads = $this->mergeAllSquads($armies, $armyKey);
            $defendingSquad = $this->determineDefender($allSquads, $army->getStrategy());
            $rivals['defender'] = $defendingSquad;

            break;
        }
    }

    /**
     * Prepare a general array of Squad units ready to be chosen from to became a defending side
     *
     * @param array $armies
     * @param int $armyKey
     * @return array
     */
    private function mergeAllSquads(array $armies, int $armyKey): array
    {
        // Unset from array of Army units the attacking Army unit
        unset($armies[$armyKey]);

        // Merge all Squad units of all Armies into one array
        $allSquads = [];
        foreach ($armies as $army) {
            $allSquads = array_merge($allSquads, $army->getUnit());
        }

        return $allSquads;
    }

    /**
     * @param array $allSquads
     * @param string $strategy
     * @return Squad
     */
    private function determineDefender(array $allSquads, string $strategy)
    {
        foreach ($this->strategies as $strategyName => $strategyClass) {
            if ($strategyName === $strategy) {
                $strategyChooser = $this->factory->create($strategyClass);
            }
        }
        $defendingSquad = $strategyChooser->choose($allSquads);

        return $defendingSquad;
    }

}