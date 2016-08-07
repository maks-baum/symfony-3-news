<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity()
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;


    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="News", mappedBy="category")
     */
    private $news;


    /**
     * Category constructor.
     */
    public function __construct(string $name = '', string $slug = '')
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->news = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName(string $name):Category
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Category
     */
    public function setSlug(string $slug):Category
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug():string
    {
        return $this->slug;
    }

    /**
     * @param ArrayCollection $news
     * @return Category
     */
    public function setNews(ArrayCollection $news):Category
    {
        $this->news = $news;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getNews():ArrayCollection
    {
        return $this->news;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}

