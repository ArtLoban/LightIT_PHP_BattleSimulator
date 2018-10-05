<?php

namespace Services\ConfigUploader\Contracts;

interface ConfigUploaderInterface
{
    /**
     * @param string $fileName
     * @return array|null
     */
    public function getConfig(string $fileName): ?array;
}
