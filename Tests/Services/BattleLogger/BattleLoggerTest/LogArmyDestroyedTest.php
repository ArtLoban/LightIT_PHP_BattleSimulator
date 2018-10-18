<?php

namespace Tests\Services\BattleLogger\BattleLoggerTest;

use Tests\Services\BattleLogger\BattleLoggerTest;

class LogArmyDestroyedTest extends BattleLoggerTest
{
    /**
     * Test logArmyDestroyed method
     *
     * @covers \Services\BattleLogger\BattleLogger::logArmyDestroyed()
     * @dataProvider logArmyDestroyedDataProvider
     */
    public function testLogArmyDestroyed(int $armyId)
    {
        $this->battleLogger->logArmyDestroyed($armyId);
    }

    /**
     * @return array
     */
    public function logArmyDestroyedDataProvider(): array
    {
        return [
            [1],
            [2],
        ];
    }
}
