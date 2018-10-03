<?php

namespace Services\BattleSimulator;

use App\Models\Squad;
use Services\BattleLogger\BattleLogger;
use Services\BattleStrategy\StrategyFactory;

class BattleSimulator
{
    /**
     * @var
     */
    private $battleMaster;

    private $strategyFactory;

    private $logger;

    /**
     * BattleSimulator constructor.
     * @param BattleMaster $battleMaster
     * @param StrategyFactory $strategyBuilderFactory
     */
    public function __construct(BattleMaster $battleMaster, StrategyFactory $strategyFactory, BattleLogger $battleLogger)
    {
        $this->battleMaster = $battleMaster;
        $this->strategyFactory = $strategyFactory;
        $this->logger = $battleLogger;
    }

    /**
     * Manage the simulation.
     * If there are more then one Army left, initiate the next battle round.
     * If there only one Army unit left it becomes a winner of battle
     * @param array $armies
     */
    public function simulate(array $armies): void
    {
        /**
         * Counter of the battle rounds
         */
        static $counter = 1;

        $checkedArmies = $this->removeArmyIfHasNoSquads($armies);

        // Launch new iterations until only one Army unit left
        if (count($checkedArmies) > 1) {
            $counter++;
            $this->startIteration($checkedArmies);
        } else {
            echo PHP_EOL . 'Rounds - ' . $counter . PHP_EOL . PHP_EOL;
            echo $this->determineWiner($checkedArmies, $counter) . PHP_EOL;
        }
    }

    /**
     * @param array $armies
     * @return string
     */
    private function determineWiner(array $armies, int $counter = 1): string
    {
//        print_r($armies); die();
        $winner = array_shift($armies);
        $winnerId = $winner->getArmyId();
        $this->logger->logWinner($winnerId, $counter);

        return '> The Winner is Army-'. $winnerId . ' <'. PHP_EOL;
    }

    /**
     * Arrange one cycle of the battle.
     * One Squad of each Army makes one attacking attempt
     *
     * @param array $armies
     */
    private function startIteration(array $armies): void
    {
        foreach ($armies as $armyKey => $army) {
            // Skip the iteration if this Army unit lost its last Squad in previous battle act
            if (empty($army->getUnit())) {
                continue;
            }

            // Determine attacking Squad
            $attackingSquad = $army->chooseRandomUnit();

            // Determine defending Squad
            $allSquads = $this->mergeAllSquads($armies, $armyKey);
            $defendingSquad = $this->determineDefender($allSquads, $army->getStrategy());

            // Determine the winner
            $this->battleMaster->runBattle($attackingSquad, $defendingSquad);

            // Remove defending Squad from Army unit if it contains no more Units
            $units = $defendingSquad->getUnits();
            if (empty($units)) {
                $this->removeSquadFromArmy($defendingSquad, $armies);
                $this->logger->logSquadDestroyed($defendingSquad->getSquadId(), $defendingSquad->getArmyId());
            }
        }

        // Run the next cycle of the battle simulation
        $this->simulate($armies);
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
     * Choose a defending Squad according to a given strategy option
     *
     * @param array $allSquads
     * @param string $strategy
     * @return Squad
     */
    private function determineDefender(array $allSquads, string $strategy): Squad
    {
        $strategyGetter = $this->strategyFactory->buildStrategy($strategy);
        $defendingSquad = $strategyGetter->get($allSquads);

        return $defendingSquad;
    }

    /**
     * Remove Squad unit from Army $units property
     *
     * @param Squad $squad
     * @param array $armies
     */
    private function removeSquadFromArmy(Squad $squad, array $armies): void
    {
        foreach ($armies as $army) {
            $army->removeUnit($squad);
        }
    }

    /**
     * @param array $armies
     */
    private function removeArmyIfHasNoSquads(array $armies): array
    {
        foreach ($armies as $key => $army) {
            $squads = $army->getUnit();

            if (empty($squads)) {
                $this->logger->logArmyDestroyed($armies[$key]->getArmyId());
                unset($armies[$key]);
            }
        }

        return $armies;
    }

}