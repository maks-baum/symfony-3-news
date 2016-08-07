<?php

namespace AppBundle\Interfaces;

interface ImageInterface
{
    /**
     * @param string $url
     * @param int $width
     * @param int $height
     */
    public function __construct(string $url, int $width, int $height);

    /**
     * @param string $url
     * @return ImageInterface
     */
    public function setUrl(string $url):ImageInterface;

    /**
     * @return string
     */
    public function getUrl():string;

    /**
     * @param int $width
     * @param int $height
     * @return ImageInterface
     */
    public function setDimensions(int $width, int $height):ImageInterface;

    /**
     * @return array
     */
    public function getDimensions():array;
}