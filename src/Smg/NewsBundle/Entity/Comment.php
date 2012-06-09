<?php

namespace Smg\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="smg_comment")
 */
class Comment {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="News", inversedBy="comments")
     */
    protected $news;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $author;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $content;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;
    
    function __construct() {
        $this->created = new \DateTime('now');
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNews() {
        return $this->news;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getContent() {
        return $this->content;
    }

    public function getCreated() {
        return $this->created;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setNews($news) {
        $this->news = $news;
        return $this;
    }

    public function setAuthor($author) {
        $this->author = $author;
        return $this;
    }

    public function setContent($content) {
        $this->content = $content;
        return $this;
    }



    
}