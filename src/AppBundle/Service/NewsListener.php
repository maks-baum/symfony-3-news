<?php

namespace AppBundle\Service;

use AppBundle\Entity\News;
use AppBundle\Interfaces\ImageProviderInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class NewsListener
{
    /**
     * @var ImageProviderInterface
     */
    protected $api;

    /**
     * NewsListener constructor.
     * @param ImageProviderInterface $api
     */
    public function __construct(ImageProviderInterface $api)
    {
        $this->api = $api;
    }

    /**
     * @param News $news
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(News $news, PreUpdateEventArgs $args)
    {
        if ($news->getTags()->count() > 0) {
            $news->setImage($this->api->getImage($news->getTags()->get($news->getTags()->getKeys()[rand(0, $news->getTags()->count()-1)])));
        }
    }

    /**
     * @param News $news
     * @param LifecycleEventArgs $a
     */
    public function prePersist(News $news, LifecycleEventArgs $a)
    {
        if ($news->getTags()->count() > 0) {
            $news->setImage($this->api->getImage($news->getTags()->get($news->getTags()->getKeys()[rand(0, $news->getTags()->count()-1)])));
        }
    }
}