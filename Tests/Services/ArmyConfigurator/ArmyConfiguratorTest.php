<?php

namespace Tests\Services\ArmyConfigurator;

use PHPUnit\Framework\TestCase;
use Services\ArmyConfigurator\ConfigurationFactory;

abstract class ArmyConfiguratorTest extends TestCase
{
    /**
     * @param $strategyClass
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockConfigurationFactory($strategyClass): object
    {
        $factory = $this->getMockBuilder(ConfigurationFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $factory->method('getConfigurator')->willReturn($strategyClass);

        return $factory;
    }

    /**
     * Provide the list with test data
     *
     * @return array
     */
    public function getTestList(): array
    {
        return [
            'army_1',
            'army_2',
            'army_3',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        gc_collect_cycles();
    }
}
