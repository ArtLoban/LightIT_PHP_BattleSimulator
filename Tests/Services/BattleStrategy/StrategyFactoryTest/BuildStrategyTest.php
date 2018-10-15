<?php

namespace Tests\Services\BattleStrategy\StrategyFactoryTest;

use PHPUnit\Framework\TestCase;
use Services\BattleStrategy\Strategies\Random;
use Services\BattleStrategy\Strategies\Strongest;
use Services\BattleStrategy\Strategies\Weakest;
use Services\BattleStrategy\StrategyFactory;
use Services\ClassFactory\Factory;

class BuildStrategyTest extends TestCase
{
    /**
     * Test buildStrategy method
     *
     * @covers \Services\BattleStrategy\StrategyFactory::buildStrategy()
     * @dataProvider buildStrategyDataProvider
     */
    public function testBuildStrategy(string $strategyAlias, string $strategyClass)
    {
        $mockStrategy = $this->mockStrategy($strategyClass);
        $mockFactory = $this->mockFactory($mockStrategy);
        $configFactory = new StrategyFactory($mockFactory);
        $strategyInstance = $configFactory->buildStrategy($strategyAlias);

        $this->assertInstanceOf($strategyClass, $strategyInstance);
    }

    /**
     * @return array
     */
    public function buildStrategyDataProvider(): array
    {
        return [
            ['random', Random::class],
            ['weakest', Weakest::class],
            ['strongest', Strongest::class],
        ];
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockFactory(object $strategy): object
    {
        $mockFactory = $this->getMockBuilder(Factory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mockFactory->method('create')->willReturn($strategy);

        return $mockFactory;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockStrategy(string $strategyClass): object
    {
        return $this->createMock($strategyClass);
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown(): void
    {
        gc_collect_cycles();
    }
}
