<?php

namespace Services\ArmyConfigurator;


class ArmyConfigurator
{
    /**
     * @var ConfigurationFactory
     */
    private $factory;

    /**
     * ArmyConfigurator constructor.
     * @param ConfigurationFactory $factory
     */
    public function __construct(ConfigurationFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Provide the list with armies configurations
     * First checks configuration file. If none given, applies generation of random armies
     *
     * @return array
     */
    public function getList(): array
    {
        $configurator = $this->factory->getConfigurator('fromConfigCollector');
        $list = $configurator->getArmiesList();

        if (empty($list)) {
            $configurator = $this->factory->getConfigurator('randomCollector');
            $list = $configurator->getArmiesList();
        }

//        print_r($list); die();

        return $list;
    }
}
