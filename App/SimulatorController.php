<?php

namespace App;

use Services\ArmyConfigurator\ConfigureStrategy;
use Services\ArmyGenerator\GenerateArmy;
use Services\BattleSimulator\BattleSimulator;

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
     * SimulatorController constructor.
     */
    public function __construct(
        GenerateArmy $generateArmy,
        BattleSimulator $battleSimulator,
        ConfigureStrategy $configureStrategy
    )
    {
        $this->armiesGenerator = $generateArmy;
        $this->simulator = $battleSimulator;
        $this->configureStrategy = $configureStrategy;
    }

    /**
     * Start the simulation
     */
    public function start(): void
    {
        echo PHP_EOL . '+++! Simulation starts here! !+++' . PHP_EOL. PHP_EOL;

        // Receive the list of armies to generate
        $listOfArmies = $this->getArmyConfiguration();

        // Generate armies according to the list
        $armies = $this->armiesGenerator->generate($listOfArmies);

        // Simulate battle
        $this->simulator->simulate($armies);
    }

    /**
     * Initiate the generation of a list of armies
     * @return array
     */
    private function getArmyConfiguration(): array
    {
        $configurator = $this->configureStrategy->getConfigurator(self::LIST_CONFIGURATOR_NAME);
        $armiesList = $configurator->getArmiesList();

        return $armiesList;
    }

}