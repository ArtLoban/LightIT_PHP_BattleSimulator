<?php

namespace Services\ArmyConfigurator\Strategies;

use Services\ArmyConfigurator\Contracts\ConfiguratorInterface;
use Services\ConfigUploader\ConfigUploader;

class FromConfigCollector implements ConfiguratorInterface
{
    /**
     *
     */
    const FROM_JSON_FILE = 'JsonConfig';

    /**
     * Required file name
     * Without extension!
     */
    const FILE_NAME = 'battle_config';

    /**
     * @var ConfigUploader
     */
    private $configUploader;

    /**
     * FromConfigCollector constructor.
     * @param ConfigUploader $configUploader
     */
    public function __construct(ConfigUploader $configUploader)
    {
        $this->configUploader = $configUploader;
    }

    /**
     * @return array|null
     */
    public function getArmiesList(): ?array
    {
        $uploader = $this->configUploader->getUploader(self::FROM_JSON_FILE);
        $data = $uploader->getConfig(self::FILE_NAME);

        return isset($data) ? $data : null;
    }
}
