<?php

namespace Services\ConfigUploader\Strategies;

use Services\ConfigUploader\Contracts\ConfigUploaderInterface;

class JsonConfig implements ConfigUploaderInterface
{
    /**
     * @param string $fileName
     * @return array|null
     */
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
