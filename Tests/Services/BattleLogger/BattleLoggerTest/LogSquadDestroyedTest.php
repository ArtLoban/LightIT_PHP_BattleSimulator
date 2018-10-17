<?php

namespace Tests\Services\BattleLogger\BattleLoggerTest;

use Tests\Services\BattleLogger\BattleLoggerTest;

class LogSquadDestroyedTest extends BattleLoggerTest
{
    /**
     * Test logSquadDestroyed method
     *
     * @covers \Services\BattleLogger\BattleLogger::logSquadDestroyed()
     * @dataProvider logSquadDestroyedDataProvider
     */
    public function testLogSquadDestroyed(int $squadId, int $armyId)
    {
        $this->battleLogger->logSquadDestroyed($squadId, $armyId);
    }

    /**
     * @return array
     */
    public function logSquadDestroyedDataProvider(): array
    {
        return [
            [3, 3],
        ];
    }
}
