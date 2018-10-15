<?php

namespace Services\ConfigUploader;

use Services\ConfigUploader\Contracts\ConfigUploaderInterface;

class ConfigUploader
{
    /**
     * @var ConfigFactory
     */
    private $factory;

    /**
     * ConfigUploader constructor.
     * @param ConfigFactory $factory
     */
    public function __construct(ConfigFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param string $uploader
     * @return ConfigUploaderInterface
     */
    public function getUploader(string $uploader): ConfigUploaderInterface
    {
        return $this->factory->get($uploader);
    }
}
