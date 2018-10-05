<?php

namespace Services\ArmyConfigurator\Contracts;

interface ConfiguratorInterface
{
    /**
     * @return array|null
     */
    public function getArmiesList(): ?array;
}
