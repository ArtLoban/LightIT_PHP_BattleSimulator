<?php

namespace App;

use Services\ClassFactory\Factory;

class SimulatorController
{
    private $classFactory;

    public function __construct()
    {
        $this->classFactory = new Factory;
    }

    public function start()
    {
        echo PHP_EOL . '+++! Simulation starts here! !+++' . PHP_EOL. PHP_EOL;

        $listOfArmies = $this->getArmyConfiguration();

        $armiesGenerator = $this->classFactory->create('GenerateArmy');
        $armies = $armiesGenerator->generate($listOfArmies);

        print_r($armies);

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