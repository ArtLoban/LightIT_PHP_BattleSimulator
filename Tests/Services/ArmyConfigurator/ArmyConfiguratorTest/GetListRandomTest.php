<?php

namespace Tests\Services\ArmyConfigurator\ArmyConfiguratorTest;

use Services\ArmyConfigurator\ArmyConfigurator;
use Services\ArmyConfigurator\Strategies\RandomCollector;
use Tests\Services\ArmyConfigurator\ArmyConfiguratorTest;

class GetListRandomTest extends ArmyConfiguratorTest
{
    /**
     * Test getList method.
     * Option when configuration file with the necessary data is Unavailable
     * In this case random data collector is being used
     *
     * @covers \Services\ArmyConfigurator\ArmyConfigurator::getList()
     */
    public function testGetList_Random()
    {
        $data = $this->getTestList();
        $mockConfigurator = $this->mockRandomCollector($data);
        $mockConfigurationFactory = $this->mockConfigurationFactory($mockConfigurator);
        $armyConfigurator = new ArmyConfigurator($mockConfigurationFactory);

        $list = $armyConfigurator->getList();

        $this->assertNotEmpty($list);
        $this->assertInternalType('array', $list);
    }

    /**
     * @param array $data
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockRandomCollector(array $data): object
    {
        $mockRandomCollector = $this->getMockBuilder(RandomCollector::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mockRandomCollector->method('getArmiesList')->willReturn($data);

        return $mockRandomCollector;
    }
}
