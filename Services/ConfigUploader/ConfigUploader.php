<?php

namespace Services\ConfigUploader;


class ConfigUploader
{
    /**
     * @return array|null
     */
    public function getConfigList(): ?array
    {
        $jsonConfig = @file_get_contents('battle_config.json');

        if ($jsonConfig === false) {
            return null;
        }

        return json_decode($jsonConfig, true);
    }

}