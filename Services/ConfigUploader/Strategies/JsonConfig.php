<?php

namespace Services\ConfigUploader\Strategies;

use Services\ConfigUploader\Contracts\ConfigUploaderInterface;

class JsonConfig implements ConfigUploaderInterface
{
    public function getConfig(string $fileName): ?array
    {
        $fullFileName = $fileName . '.json';

        $data = @file_get_contents($fullFileName);

        if ($data === false) {
            return null;
        }

        return json_decode($data, true);
    }

}