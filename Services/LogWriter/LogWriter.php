<?php

namespace Services\LogWriter;

use Exception;

class LogWriter implements LogWriterInterface
{
    /**
     * @param string $fileName
     * @param string $data
     * @return int
     */
    public function write(string $fileName, string $data): int
    {
        set_error_handler(function ($severity, $message, $file, $line) {
            throw new Exception('Custom Error: Failed to write data');
        });
        $result = file_put_contents($fileName, $data, FILE_APPEND);
        restore_error_handler();

        return $result;
    }
}
