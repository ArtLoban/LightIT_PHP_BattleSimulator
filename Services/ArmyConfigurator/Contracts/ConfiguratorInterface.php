<?php

namespace Services\ArmyConfigurator\Contracts;

interface ConfiguratorInterface
{
    /**
     * @return array
     */
    public function getArmiesList(): array;
}