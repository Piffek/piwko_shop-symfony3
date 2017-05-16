<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\OneToOne;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
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
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;
	
	
	 /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;
	
	 /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

	/**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255, nullable=true)
     */
    private $street;
    
    
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=60, unique=true, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=64, unique=true, nullable=true)
     */
    private $email;

    /**
     * @var bool
     *
     * @ORM\Column(name="isActive", type="boolean", nullable=true)
     */
    private $isActive;
    
    /**
     * @ORM\OneToMany(targetEntity="Basket", mappedBy="user")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $basket;
    
    
    /**
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="security_users_roles")
     */
    protected $roles;
    
    
    /**
     *
     * @var unknown
     * @ORM\OneToMany(targetEntity="Buying", mappedBy="user")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $buying;

    public function __construct()
    {
    	$this->isActive = true;
    	$this->roles= new \Doctrine\Common\Collections\ArrayCollection();
    	$this->buying= new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->email;
    }
    
    public function getPlainPassword()
    {
    	return $this->plainPassword;
    }
    
    public function setPlainPassword($plainPassword)
    {
    	$this->plainPassword = $plainPassword;
    	
    	$this->password = null;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
   
    
    public function getSalt()
    {
    	// you *may* need a real salt depending on your encoder
    	// see section on salt below
    	return null;
    }
    
    public function eraseCredentials()
    {
    	$this->plainPassword = null;
    	
    }
    
    /** @see \Serializable::serialize() */
    public function serialize()
    {
    	return serialize(
    			array(
    					$this->id,
    					$this->email,
    					$this->password,
    			));
    }
    
    public function unserialize($serialized)
    {
    	list (
    		$this->id,
    		$this->email,
    		$this->password,
    		) = unserialize($serialized);
    }

    /**
     * Add role
     *
     * @param \AppBundle\Entity\Role $role
     *
     * @return User
     */
    public function addRoles(\AppBundle\Entity\Role $role)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \AppBundle\Entity\Role $role
     */
    public function removeRoles(\AppBundle\Entity\Role $roles)
    {
        $this->role->removeElement($roles);
    }

    /**
     * Get role
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoles()
    { 
		$roles = array_merge( $this->roles->toArray(), array( new Role()));
		
		foreach($roles as $role)
		{
			if(!is_null($role->getName())){
				return array($role);
			}else {
				return ['ROLE_USER'];
			}
		}
		
		
    }
    
    
    
    public function setRoles(array $roles)
    {
    	$this->roles = $roles;
    	
    	// allows for chaining
    	return $this;
    }


   

    /**
     * Add basket
     *
     * @param \AppBundle\Entity\Item $basket
     *
     * @return User
     */
    public function addBasket(\AppBundle\Entity\Item $basket)
    {
        $this->basket[] = $basket;

        return $this;
    }

    /**
     * Remove basket
     *
     * @param \AppBundle\Entity\Item $basket
     */
    public function removeBasket(\AppBundle\Entity\Item $basket)
    {
        $this->basket->removeElement($basket);
    }

    /**
     * Get basket
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBasket()
    {
        return $this->basket;
    }

    /**
     * Add role
     *
     * @param \AppBundle\Entity\Role $role
     *
     * @return User
     */
    public function addRole(\AppBundle\Entity\Role $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \AppBundle\Entity\Role $role
     */
    public function removeRole(\AppBundle\Entity\Role $role)
    {
        $this->roles->removeElement($role);
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return User
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Add buying
     *
     * @param \AppBundle\Entity\Buying $buying
     *
     * @return User
     */
    public function addBuying(\AppBundle\Entity\Buying $buying)
    {
        $this->buying[] = $buying;

        return $this;
    }

    /**
     * Remove buying
     *
     * @param \AppBundle\Entity\Buying $buying
     */
    public function removeBuying(\AppBundle\Entity\Buying $buying)
    {
        $this->buying->removeElement($buying);
    }

    /**
     * Get buying
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBuying()
    {
        return $this->buying;
    }
}
