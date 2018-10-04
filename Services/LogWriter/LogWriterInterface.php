<?php

namespace Services\LogWriter;

interface LogWriterInterface
{
    /**
     * @param $fileName
     * @param $data
     */
    public function write($fileName, $data): void ;
}
