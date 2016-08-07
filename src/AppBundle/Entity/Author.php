<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Author
 *
 * @ORM\Table(name="authors")
 * @ORM\Entity()
 */
class Author
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
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;


    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="News", mappedBy="author")
     */
    private $news;


    /**
     * Author constructor.
     */
    public function __construct(string $name = '', string $email = '')
    {
        $this->name = $name;
        $this->email = $email;
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
     * @return Author
     */
    public function setName(string $name):Author
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
     * Set email
     *
     * @param string $email
     *
     * @return Author
     */
    public function setEmail(string $email):Author
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail():string
    {
        return $this->email;
    }

    /**
     * @return ArrayCollection
     */
    public function getNews():ArrayCollection
    {
        return $this->news;
    }

    /**
     * @param ArrayCollection $news
     * @return Author
     */
    public function setNews($news):Author
    {
        $this->news = $news;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString():string
    {
        return $this->getName();
    }
}

