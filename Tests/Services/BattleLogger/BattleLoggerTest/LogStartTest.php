<?php

namespace Tests\Services\BattleLogger\BattleLoggerTest;

use Tests\Services\BattleLogger\BattleLoggerTest;

class LogStartTest extends BattleLoggerTest
{
    /**
     * Test logStart method
     *
     * @covers \Services\BattleLogger\BattleLogger::logStart()
     * @dataProvider logStartDataProvider
     */
    public function testLogStart(array $testData)
    {
        $this->battleLogger->logStart($testData);
    }

    /**
     * @return array
     */
    public function logStartDataProvider(): array
    {
        return [
            [$this->getTestListOfArmies()],
        ];
    }

    /**
     * @return array
     */
    public function getTestListOfArmies():array
    {
        return [
            [
                'strategy' => 'random',
                'squads' => [
                    'soldiers' => ['test'],
                    'vehicles' => ['test'],
                ],
            ]
        ];
    }
}
