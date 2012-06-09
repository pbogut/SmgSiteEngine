<?php

namespace Smg\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Smg\NewsBundle\Repository\NewsRepository")
 * @ORM\Table(name="smg_news")
 * @ORM\HasLifecycleCallbacks()
 */
class News {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $title;
    
    /**
     * @ORM\Column(type="string", length=128, nullable="true") 
     */
    protected $slug;

        
    /**
     * @ORM\Column(type="text")
     */
    protected $content;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $tags;
 
    //todo Autor jako obiekt, kiedyś tam
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $author;
    
    //todo Dodać kategorie
    //protected $category;
    
    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="news", cascade={"persist", "remove"})
     */
    protected $comments;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;
    
    /**
     * @ORM\Column(type="datetime", nullable="true")
     */
    protected $updated;

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->updated = new \DateTime('now');
    }

    function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->created = new \DateTime('now');
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent($length = null)
    {
        if ($length != null && $length > 0)
            return substr($this->content, 0, $length);
        else
            return $this->content;
    }

    public function getTags() 
    {
        return $this->tags;
    }
    
    public function getTagsArray() 
    {
        return explode(',', $this->tags);
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getComments()
    {
        return $this->comments;
    }
    
    public function hasMore($more_than = null) {
        if ($more_than == null)
            return false;
        
        $left = strlen($this->content)-$more_than;
        if ($left > 0)
            return true;
        else
            return false;
    }
    
    public function countComments()
    {
        return count($this->comments);
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getUpdated()
    {
        return $this->updated;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function setTags($tags)
    {
        $this->tags = strtolower($tags);
        return $this;
    }
    
    public function addTag($tag)
    {
        $this->tags .= ', ' . strtolower($tag)
;        return $this;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    public function addComment($comment)
    {
        $this->comments[] = $comment;
        return $this;
    }

    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

}