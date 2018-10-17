<?php

namespace Tests\Services\BattleSimulator\BattleMasterTest;

use App\Models\Squad;
use PHPUnit\Framework\TestCase;
use Services\BattleLogger\BattleLogger;
use Services\BattleSimulator\BattleMaster;

class RunBattleTest extends TestCase
{
    /**
     * Comparing attack probability values of opposing Squad units
     */
    const LOWER_ATTACK_VALUE = 1.5;
    const HIGHER_ATTACK_VALUE = 2.5;

    /**
     * Test runBattle method
     *
     * @covers \Services\BattleSimulator\BattleMaster::runBattle()
     * @dataProvider runBattleDataProvider
     */
    public function testRunBattle(float $lowAttackProbability, float $highAttackProbability)
    {
        $battleLogger = $this->mockBattleLogger();
        $battleMaster = new BattleMaster($battleLogger);

        $attackingSquad = $this->mockSquad($highAttackProbability);
        $defendingSquad = $this->mockSquad($lowAttackProbability);

        $battleMaster->runBattle($attackingSquad, $defendingSquad);
    }

    /**
     * @return array
     */
    public function runBattleDataProvider(): array
    {
        return [
            [self::LOWER_ATTACK_VALUE, self::HIGHER_ATTACK_VALUE],
        ];
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockBattleLogger(): object
    {
        $mockBattleLogger = $this->createMock(BattleLogger::class);
        $mockBattleLogger
            ->expects($this->atLeastOnce())
            ->method('logFight');

        return $mockBattleLogger;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockSquad(float $attackProbability = 1): object
    {
        $mockSquad = $this->createMock(Squad::class);
        $mockSquad
            ->expects($this->atLeastOnce())
            ->method('calculateAttackProbability')
            ->willReturn($attackProbability);

        return $mockSquad;
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        gc_collect_cycles();
    }
}
