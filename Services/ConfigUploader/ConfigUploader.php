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
     * @param $uploader
     * @return ConfigUploaderInterface
     */
    public function getUploader($uploader): ConfigUploaderInterface
    {
        return $this->factory->get($uploader);
    }
}
