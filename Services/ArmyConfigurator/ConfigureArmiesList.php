<?php

namespace Services\ArmyConfigurator;

use Services\ClassFactory\Factory;

class ConfigureArmiesList
{
    /**
     * @var Factory
     */
    private $factory;

    /**
     * ConfigureArmiesList constructor.
     */
    public function __construct()
    {
        $this->factory = new Factory();
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        $randomConfigurator = $this->factory->create('RandomConfigurator');

        return $randomConfigurator->getArmiesList();
    }

}