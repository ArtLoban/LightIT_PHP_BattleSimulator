<?php

namespace App;

use Services\ArmyConfigurator\ArmyConfigurator;
use Services\ArmyGenerator\GenerateArmy;
use Services\BattleLogger\BattleLogger;
use Services\BattleSimulator\BattleSimulator;

class SimulatorController
{
    /**
     * @var ArmyConfigurator
     */
    private $configurator;

    /**
     * @var GenerateArmy
     */
    private $armiesGenerator;

    /**
     * @var BattleSimulator
     */
    private $simulator;

    /**
     * @var BattleLogger
     */
    private $logger;

    /**
     * SimulatorController constructor.
     * @param ArmyConfigurator $configurator
     * @param GenerateArmy $generateArmy
     * @param BattleSimulator $battleSimulator
     * @param BattleLogger $battleLogger
     */
    public function __construct(
        ArmyConfigurator $configurator,
        GenerateArmy $generateArmy,
        BattleSimulator $battleSimulator,
        BattleLogger $battleLogger
    )
    {
        $this->configurator = $configurator;
        $this->armiesGenerator = $generateArmy;
        $this->simulator = $battleSimulator;
        $this->logger = $battleLogger;
    }

    /**
     * Start the simulation
     */
    public function start(): void
    {
        echo PHP_EOL . '+++! Simulation starts here! !+++' . PHP_EOL. PHP_EOL;

        // Receive the list of armies to generate
        $listOfArmies = $this->configurator->getList();

        // Start logging
        $this->logger->logStart($listOfArmies);

        // Generate armies according to the list
        $armies = $this->armiesGenerator->generate($listOfArmies);

        // Simulate battle
        $this->simulator->simulate($armies);
    }
}
