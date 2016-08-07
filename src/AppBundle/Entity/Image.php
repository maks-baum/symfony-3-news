<?php

namespace AppBundle\Entity;

use AppBundle\Interfaces\ImageInterface;

class Image implements ImageInterface
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var array
     */
    protected $dimensions;

    /**
     * Image constructor.
     * @param string $url
     */
    public function __construct(string $url = '', int $width = 0, int $height = 0)
    {
        $this->url = $url;
        $this->dimensions = [$width, $height];
    }

    /**
     * @param string $url
     * @return ImageInterface
     */
    public function setUrl(string $url):ImageInterface
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl():string
    {
        return $this->url;
    }

    /**
     * @param int $width
     * @param int $height
     * @return ImageInterface
     */
    public function setDimensions(int $width = 0, int $height = 0):ImageInterface
    {
        $this->dimensions = [$width, $height];
    }

    /**
     * @return array
     */
    public function getDimensions():array
    {
        return $this->dimensions;
    }

    /**
     * @return string
     */
    public function __toString():string
    {
        return $this->getUrl();
    }
}