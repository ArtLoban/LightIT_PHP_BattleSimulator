<?php

namespace App;

use Services\ArmyConfigurator\ArmyConfigurator;
use Services\ArmyGenerator\ArmyGenerator;
use Services\BattleLogger\BattleLogger;
use Services\BattleSimulator\BattleSimulator;

class SimulatorController
{
    /**
     * @var ArmyConfigurator
     */
    private $configurator;

    /**
     * @var ArmyGenerator
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
     * @param ArmyGenerator $generateArmy
     * @param BattleSimulator $battleSimulator
     * @param BattleLogger $battleLogger
     */
    public function __construct(
        ArmyConfigurator $configurator,
        ArmyGenerator $generateArmy,
        BattleSimulator $battleSimulator,
        BattleLogger $battleLogger
    ) {
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
