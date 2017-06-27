<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * Rental
 *
 * @ORM\Table(name="rental")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RentalRepository")
 */
class Rental
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
     * @var int
     * @ORM\ManyToOne(targetEntity="Item", inversedBy="rental")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
    protected $item;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="forWhen", type="datetime")
     */
    private $forWhen;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="rental")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
    
    /**
     * One Customer has One Cart.
     * @OneToOne(targetEntity="Item", mappedBy="rentalId")
     */
    private $rentalItem;

    public function __construct()
    {
    	$this->user= new \Doctrine\Common\Collections\ArrayCollection();
    	$this->item= new \Doctrine\Common\Collections\ArrayCollection();
    	$this->setCreatedAt();

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
     * Set item
     *
     * @param integer $item
     *
     * @return Rental
     */
    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return int
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Rental
     */
    public function setCreatedAt()
    {
    	if(!$this->createdAt){
    		$this->createdAt = new \DateTime();
    	}
    	
    	return $this;    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set forWhen
     *
     * @param \DateTime $forWhen
     *
     * @return Rental
     */
    public function setForWhen($forWhen)
    {
        $this->forWhen = $forWhen;

        return $this;
    }

    /**
     * Get forWhen
     *
     * @return \DateTime
     */
    public function getForWhen()
    {
        return $this->forWhen;
    }

    /**
     * Set user
     *
     * @param integer $user
     *
     * @return Rental
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }
}

