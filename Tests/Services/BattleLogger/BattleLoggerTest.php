<?php

namespace Tests\Services\BattleLogger;

use PHPUnit\Framework\TestCase;
use Services\BattleLogger\BattleLogger;
use Services\LogWriter\LogWriter;

abstract class BattleLoggerTest extends TestCase
{
    /**
     * @var BattleLoggerTest
     */
    public $battleLogger;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $mockLogWriter = $this->mockLogWriter();
        $this->battleLogger = new BattleLogger($mockLogWriter);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockLogWriter(): object
    {
        $logWriter = $this->createMock(LogWriter::class);
        $logWriter
            ->expects($this->once())
            ->method('write');

        return $logWriter;
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown(): void
    {
        $this->battleLogger = null;
        gc_collect_cycles();
    }
}
