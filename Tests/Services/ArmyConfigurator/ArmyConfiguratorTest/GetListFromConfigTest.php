<?php

namespace Tests\Services\ArmyConfigurator\ArmyConfiguratorTest;

use Services\ArmyConfigurator\ArmyConfigurator;
use Services\ArmyConfigurator\Strategies\FromConfigCollector;
use Tests\Services\ArmyConfigurator\ArmyConfiguratorTest;

class GetListFromConfigTest extends ArmyConfiguratorTest
{
    /**
     * Test getList method.
     * Option when configuration file is available
     *
     * @covers \Services\ArmyConfigurator\ArmyConfigurator::getList()
     */
    public function testGetList_FromConfig()
    {
        $data = $this->getTestList();
        $mockConfigurator = $this->mockFromConfigCollector($data);
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
    public function mockFromConfigCollector(array $data): object
    {
        $mockFromConfigCollector = $this->getMockBuilder(FromConfigCollector::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mockFromConfigCollector->method('getArmiesList')->willReturn($data);

        return $mockFromConfigCollector;
    }
}
