<?php

namespace Tests\Services\BattleLogger\BattleLoggerTest;

use Tests\Services\BattleLogger\BattleLoggerTest;

class LogWinnerTest extends BattleLoggerTest
{
    /**
     * Test logWinner method
     *
     * @covers \Services\BattleLogger\BattleLogger::logWinner()
     * @dataProvider logWinnerDataProvider
     */
    public function testLogWinner(int $winnerId, int $counter)
    {
        $this->battleLogger->logWinner($winnerId, $counter);
    }

    /**
     * @return array
     */
    public function logWinnerDataProvider(): array
    {
        return [
            [1, 20],
        ];
    }
}
