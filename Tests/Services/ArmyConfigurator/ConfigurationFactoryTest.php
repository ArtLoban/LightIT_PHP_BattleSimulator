<?php

namespace Tests\Services\ArmyConfigurator;

use PHPUnit\Framework\TestCase;
use Services\ArmyConfigurator\ConfigurationFactory;
use Services\ArmyConfigurator\Strategies\FromConfigCollector;
use Services\ArmyConfigurator\Strategies\RandomCollector;
use Services\ClassFactory\Factory;

class ConfigurationFactoryTest extends TestCase
{
    /**
     * Test getConfigurator method
     *
     * @covers \Services\ArmyConfigurator\ConfigurationFactory::getConfigurator()
     * @dataProvider configuratorDataProvider
     */
    public function testGetConfigurator(object $strategyClass, string $strategy, string $className)
    {
        $mockFactory = $this->mockFactory($strategyClass);
        $configurationFactory = new ConfigurationFactory($mockFactory);

        $chosenStrategy = $configurationFactory->getConfigurator($strategy);
        $this->assertInternalType('object', $chosenStrategy);
        $this->assertInstanceOf($className, $chosenStrategy);
    }

    /**
     * @return array
     */
    public function configuratorDataProvider(): array
    {
        return [
            [$this->getRandomCollectorMock(), 'randomCollector', RandomCollector::class],
            [$this->getFromConfigCollectorMock(), 'fromConfigCollector', FromConfigCollector::class],
        ];
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function getRandomCollectorMock(): object
    {
        return $this->createMock(RandomCollector::class);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function getFromConfigCollectorMock(): object
    {
        return $this->createMock(FromConfigCollector::class);
    }

    /**
     * @param $strategyClass
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockFactory($strategyClass)
    {
        $factory = $this->getMockBuilder(Factory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $factory->method('create')->willReturn($strategyClass);

        return $factory;
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->generateArmy = null;
        gc_collect_cycles();
    }
}
