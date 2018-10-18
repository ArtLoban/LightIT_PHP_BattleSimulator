<?php

namespace Tests\App\SimulatorControllerTest;

use App\SimulatorController;
use PHPUnit\Framework\TestCase;
use Services\ArmyConfigurator\ArmyConfigurator;
use Services\ArmyGenerator\ArmyGenerator;
use Services\BattleLogger\BattleLogger;
use Services\BattleSimulator\BattleSimulator;

class StartTest extends TestCase
{
    /**
     * Test start method
     *
     * @covers \App\SimulatorController::start()
     * @dataProvider startDataProvider
     */
    public function testStart(
        string $class_1,
        string $method_1,
        string $class_2,
        string $method_2,
        string $class_3,
        string $method_3,
        string $class_4,
        string $method_4
    ) {
        $mockArmyConfigurator = $this->mockDependency($class_1, $method_1);
        $mockArmyGenerator = $this->mockDependency($class_2, $method_2);
        $mockBattleSimulator = $this->mockDependency($class_3, $method_3);
        $mockBattleLogger = $this->mockDependency($class_4, $method_4);

        $simulatorController = new SimulatorController(
            $mockArmyConfigurator,
            $mockArmyGenerator,
            $mockBattleSimulator,
            $mockBattleLogger
        );

        $simulatorController->start();
    }

    /**
     * @return array
     */
    public function startDataProvider(): array
    {
        return [
            [
                ArmyConfigurator::class,
                'getList',
                ArmyGenerator::class,
                'generate',
                BattleSimulator::class,
                'simulate',
                BattleLogger::class,
                'logStart',
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
            ->expects($this->once())
            ->method($methodName);

        return $dependency;
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        gc_collect_cycles();
    }
}
