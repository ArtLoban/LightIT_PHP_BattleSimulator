<?php

namespace Services\ConfigUploader;

class JsonConfig implements ConfigUploaderInterface
{
    public function getConfig(string $fileName): ?array
    {
        $fullFileName = $fileName . '.json';

        $jsonConfig = @file_get_contents($fullFileName);

        if ($jsonConfig === false) {
            return null;
        }

        return json_decode($jsonConfig, true);
    }

}