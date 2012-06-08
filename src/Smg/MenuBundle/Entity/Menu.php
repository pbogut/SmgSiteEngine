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
    
    //, fetch="EAGER"
    /**
     * @ORM\OneToMany(targetEntity="Item", mappedBy="menu", cascade={"persist", "remove"})
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
    protected $class;
    

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

    public function getClass() {
        return $this->class;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setItems($items) {
        $this->items = $items;
        return $this;
    }
    
    public function addItem(Item $item) {
        $this->items[] = $item;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setClass($class) {
        $this->class = $class;
        return $this;
    }

    public function __toString() {
        return $this->name;
    }

}