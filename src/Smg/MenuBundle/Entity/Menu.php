<?php

namespace Smg\MenuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="smg_menu")
 */
class Menu
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Item", mappedBy="menu", fetch="EAGER")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $items;
    
    /**
     * @ORM\Column(type="string", length=25)
     * @var type 
     */
    protected $name;
    
    /**
     * @ORM\Column(type="string", length=50)
     * @var type 
     */
    protected $title;
    
    /**
     * @ORM\Column(type="boolean")
     * @var $published boolean
     */
    protected $published;

    function __construct() {
        $this->items = new ArrayCollection();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getItems() {
        return $this->items;
    }

    public function getName() {
        return $this->name;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getPublished() {
        return $this->published;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setItems($items) {
        $this->items = $items;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function setPublished($published) {
        $this->published = $published;
        return $this;
    }
    
    public function __toString() {
        return $this->name;
    }

}