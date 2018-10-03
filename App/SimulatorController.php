<?php

namespace App;

use Services\ArmyConfigurator\ConfigureStrategy;
use Services\ArmyGenerator\GenerateArmy;
use Services\BattleLogger\BattleLogger;
use Services\BattleSimulator\BattleSimulator;
use Services\ConfigUploader\ConfigUploader;

class SimulatorController
{
    /**
     * The name of strategy which configurates the list of armies
     */
    const LIST_CONFIGURATOR_NAME = 'randomCollector';

    /**
     * @var GenerateArmy
     */
    private $armiesGenerator;

    /**
     * @var BattleSimulator
     */
    private $simulator;

    /**
     * @var ConfigureStrategy
     */
    private $configureStrategy;

    /**
     * @var
     */
    private $configUploader;

    private $logger;

    /**
     * SimulatorController constructor.
     */
    public function __construct(
        GenerateArmy $generateArmy,
        BattleSimulator $battleSimulator,
        ConfigUploader $configUploader,
        ConfigureStrategy $configureStrategy,
        BattleLogger $battleLogger
    )
    {
        $this->armiesGenerator = $generateArmy;
        $this->simulator = $battleSimulator;
        $this->configUploader = $configUploader;
        $this->configureStrategy = $configureStrategy;
        $this->logger = $battleLogger;
    }

    /**
     * Start the simulation
     */
    public function start(): void
    {
        echo PHP_EOL . '+++! Simulation starts here! !+++' . PHP_EOL. PHP_EOL;

        // Receive the list of armies to generate
        $listOfArmies = $this->getArmyConfiguration();

        // Start logging
        $this->logger->logStart($listOfArmies);

        // Generate armies according to the list
        $armies = $this->armiesGenerator->generate($listOfArmies);

        // Simulate battle
        $this->simulator->simulate($armies);
    }

    /**
     * Provide the list of armies
     *
     * @return array
     */
    private function getArmyConfiguration(): array
    {
        // Get configuration from file
        $armiesList = $this->configUploader->getConfigList();
        if ($armiesList != null) {
            return $armiesList;
        }

        // Generate configuration list
        $configurator = $this->configureStrategy->getConfigurator(self::LIST_CONFIGURATOR_NAME);
        $armiesList = $configurator->getArmiesList();

        return $armiesList;
    }

}