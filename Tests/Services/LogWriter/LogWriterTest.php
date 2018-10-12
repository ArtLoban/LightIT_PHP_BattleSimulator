<?php

namespace Tests\Services\LogWriter;

use PHPUnit\Framework\TestCase;
use Services\LogWriter\LogWriter;

abstract class LogWriterTest extends TestCase
{
    /**
     * @var LogWriter
     */
    public $logWriter;

    /**
     * {@inheritdoc}
     */
    public function setUp(): void
    {
        $this->logWriter = new LogWriter();
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown(): void
    {
        $this->logWriter = null;
        gc_collect_cycles();
    }
}
