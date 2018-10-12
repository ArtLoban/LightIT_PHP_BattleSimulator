<?php

namespace Services\LogWriter;

interface LogWriterInterface
{
    /**
     * @param $fileName
     * @param $data
     * @return mixed
     */
    public function write(string $fileName, string $data);
}
