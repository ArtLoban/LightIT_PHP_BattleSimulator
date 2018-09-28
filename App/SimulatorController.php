<?php

namespace App;

use Services\ClassFactory\Factory;

class SimulatorController
{
    /**
     * @var Factory
     */
    private $classFactory;

    /**
     * SimulatorController constructor.
     */
    public function __construct()
    {
        $this->classFactory = new Factory;
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
        $armiesGenerator = $this->classFactory->create('GenerateArmy');
        $armies = $armiesGenerator->generate($listOfArmies);

        // Simulate battle
        $simulator = $this->classFactory->create('BattleSimulator');
        $simulator->simulate($armies);
    }

    /**
     * Initiate the generation of a list of armies
     * @return array
     */
    private function getArmyConfiguration(): array
    {
        $armiesList = $this->classFactory->create('ConfigureArmiesList');

        return $armiesList->getList();
    }

}