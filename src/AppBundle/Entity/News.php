<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NewsRepository")
 * @UniqueEntity("title")
 * @UniqueEntity("slug")
 */
class News
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
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(min=1,max=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-z0-9\-]{1,255}$/")
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="text")
     * @Assert\NotBlank()
     */
    private $summary;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank()
     */
    private $content;


    /**
     * @var Author
     *
     * @ORM\ManyToOne(targetEntity="Author", inversedBy="news", cascade={"persist"})
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="news", cascade={"persist"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Tag", cascade={"persist"})
     */
    private $tags;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;


    public function __construct()
    {
        $this->title = '';
        $this->slug = '';
        $this->summary = '';
        $this->content = '';
        $this->tags = new ArrayCollection();
        $this->image = '';
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
     * Set title
     *
     * @param string $title
     *
     * @return News
     */
    public function setTitle(string $title):News
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle():string
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return News
     */
    public function setSlug(string $slug):News
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
     * Set summary
     *
     * @param string $summary
     *
     * @return News
     */
    public function setSummary(string $summary):News
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function getSummary():string
    {
        return $this->summary;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return News
     */
    public function setContent(string $content):News
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent():string
    {
        return $this->content;
    }

    /**
     * Set author
     *
     * @param \stdClass $author
     *
     * @return News
     */
    public function setAuthor(Author $author):News
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set category
     *
     * @param Category $category
     *
     * @return News
     */
    public function setCategory(Category $category):News
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \stdClass
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set tags
     *
     * @param array $tags
     *
     * @return News
     */
    public function setTags(ArrayCollection $tags):News
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return Colletion
     */
    public function getTags():Collection
    {
        return $this->tags;
    }

    /**
     * @return string
     */
    public function getImage():string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image):News
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasImage():bool
    {
        return is_string($this->image) && $this->image !== '';
    }

    /**
     * @return string
     */
    public function __toString():string
    {
        return $this->getTitle();
    }

    /**
     * @param Tag[] ...$tags
     * @return News
     */
    public function addTags(Tag ...$tags):News
    {
        foreach ($tags as $tag) {
            $this->tags->add($tag);
        }

        return $this;
    }

}

