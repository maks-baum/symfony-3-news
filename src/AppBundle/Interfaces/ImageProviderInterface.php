<?php

namespace AppBundle\Interfaces;

interface ImageProviderInterface
{
    /**
     * @param string $tag
     * @return ImageInterface
     */
    public function getImage(string $tag):ImageInterface;
}