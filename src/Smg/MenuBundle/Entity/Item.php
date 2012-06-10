<?php

namespace Smg\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="smg_menu_item")
 */
class Item
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="items")
     * @var $menu int
     */
    protected $menu;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $position;
    
    /**
     * @ORM\Column(type="string", length=55)
     * @var type 
     */
    protected $title;
    
    /**
     * @ORM\Column(name="target_url", type="string", length=255)
     * @var type 
     */
    protected $targetUrl;
    
    /**
     * @ORM\Column(type="boolean", nullable="true")
     */
    protected $published;
    
    function __construct() {
        $this->position = 0;
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getMenu() {
        return $this->menu;
    }

    public function setMenu($menu) {
        $this->menu = $menu;
        return $this;
    }

    public function getPosition() {
        return $this->position;
    }

    public function setPosition($position) {
        $this->position = $position;
        return $this;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function getTargetUrl() {
        return $this->targetUrl;
    }

    public function setTargetUrl($targetUrl) {
        $this->targetUrl = $targetUrl;
        return $this;
    }

    public function getPublished() {
        return $this->published;
    }

    public function setPublished($published) {
        $this->published = $published;
        return $this;
    }

}