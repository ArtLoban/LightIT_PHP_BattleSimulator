<?php

namespace Tests\Services\ConfigUploader\Strategies;

use PHPUnit\Framework\TestCase;
use Services\ConfigUploader\Strategies\JsonConfig;

abstract class JsonConfigTest extends TestCase
{
    /**
     * @var JsonConfig
     */
    public $jsonConfig;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->jsonConfig = new JsonConfig();
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown(): void
    {
        $this->jsonConfig = null;
        gc_collect_cycles();
    }
}
