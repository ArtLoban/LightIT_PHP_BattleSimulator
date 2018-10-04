<?php

namespace Services\LogWriter;

use Exception;
use Throwable;

class LogWriter implements LogWriterInterface
{
    public function write($fileName, $data): void
    {
        try {
            file_put_contents($fileName, $data, FILE_APPEND);
        } catch (Throwable $exception) {
            throw new Exception("Custom Error: Failed to open stream:");
        }
    }
}

