<?php

namespace Tests\Services\BattleLogger\BattleLoggerTest;

use Tests\Services\BattleLogger\BattleLoggerTest;

class LogFightTest extends BattleLoggerTest
{
    /**
     * Test logFight method
     *
     * @covers \Services\BattleLogger\BattleLogger::logFight()
     * @dataProvider logFightDataProvider
     */
    public function testLogFight(
        int $attackingSquadArmyId,
        int $attackingSquadId,
        int $defendingSquadArmyId,
        int $defendingSquadId,
        float $damage
    ) {
        $this->battleLogger->logFight(
            $attackingSquadArmyId,
            $attackingSquadId,
            $defendingSquadArmyId,
            $defendingSquadId,
            $damage
        );
    }

    /**
     * @return array
     */
    public function logFightDataProvider(): array
    {
        return [
            [1, 1, 2, 2, 3.3],
        ];
    }
}
