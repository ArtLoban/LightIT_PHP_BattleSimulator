<?php

namespace Tests\Services\BattleSimulator\BattleSimulatorTest;

use App\Models\Army;
use App\Models\Squad;
use PHPUnit\Framework\TestCase;
use Services\BattleLogger\BattleLogger;
use Services\BattleSimulator\BattleMaster;
use Services\BattleSimulator\BattleSimulator;
use Services\BattleStrategy\StrategyFactory;

class SimulateTest extends TestCase
{
    /**
     * Test simulate method
     *
     * @covers \Services\BattleSimulator\BattleSimulator::simulate()
     * @dataProvider simulateDataProvider
     */
    public function testSimulate(
        $class_1,
        $method_1,
        $class_2,
        $method_2,
        array $armies
    )
    {
        $mockBattleMaster = $this->mockDependency($class_1, $method_1);
        $mockStrategyFactory = $this->mockDependency($class_2, $method_2);
        $mockBattleLogger = $this->mockBattleLogger();

        $battleSimulator = new BattleSimulator($mockBattleMaster, $mockStrategyFactory, $mockBattleLogger);

        $battleSimulator->simulate($armies);
    }

    /**
     * @return array
     */
    public function simulateDataProvider(): array
    {
        return [
            [
                BattleMaster::class,
                'runBattle',
                StrategyFactory::class,
                'buildStrategy',
                $this->getTestArmies(),
            ],
        ];
    }

    /**
     * @param string $dependencyName
     * @param string $methodName
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockDependency(string $dependencyName, string $methodName): object
    {
        $dependency = $this->createMock($dependencyName);
        $dependency
            ->expects($this->any())
            ->method($methodName);

        return $dependency;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockBattleLogger(): object
    {
        $dependency = $this->createMock(BattleLogger::class);
        $dependency
            ->expects($this->once())
            ->method('logWinner');
        $dependency
            ->expects($this->any())
            ->method('logSquadDestroyed');
        $dependency
            ->expects($this->any())
            ->method('logArmyDestroyed');

        return $dependency;
    }

    /**
     * @param int $quantity
     * @return array
     */
    public function getTestArmies(int $quantity = 2): array
    {
        $armies = [];
        for ($i = 1; $i < $quantity; $i++) {
            $armies[] = $this->mockArmy();
        }

        return $armies;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockArmy(): object
    {
        $army = $this->createMock(Army::class);
        $army->expects($this->any())
            ->method('getUnits')
            ->willReturn([$this->mockSquad()]);

        return $army;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockSquad(): object
    {
        return $this->createMock(Squad::class);
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        gc_collect_cycles();
    }
}
