<?php

namespace Smg\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="smg_user")
 */
class User implements UserInterface {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length="128")
     */
    protected $username;
    
    /**
     * @ORM\Column(type="string", length="40")
     */
    protected $password;
    
    /**
     * @ORM\Column(type="string", length="40")
     * @var string $salt;
     */
    protected $salt;

    function __construct() {
        $this->salt = hash('sha1', new \DateTime('now'));
    }

        public function equals(UserInterface $user) {
        if (
                ($user->getUsername() == $this->username) //&&
                //($user->getSalt() == $this->salt) &&
                //($user->getPassword() == $this->password)
           ) return true;

        return false;
    }
    public function eraseCredentials() {
        
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function getRoles() {
        return array('ROLE_ADMIN');
    }
    
    public function getSalt() {
        return $this->salt;
    }
    
    public function getUsername() {
        return $this->username;
    }
    
    public function getId() {
        return $this->id;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }
    
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

}