<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
<<<<<<< HEAD
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\OneToOne;
=======
>>>>>>> f9a5da703f1eaa852002f7c713260ecd6d6375e6
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Item
 *
 * @ORM\Table(name="item")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ItemRepository")
 */
class Item
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="promotion", type="string", length=255)
     */
    private $promotion;

    /**
     * @var string
     *
     * @ORM\Column(name="textPromotion", type="string", length=255, nullable=true)
     */
    private $textPromotion;

    /**
     * @var int
     *
     * @ORM\Column(name="percentPromotion", type="integer", nullable=true)
     */
    private $percentPromotion;

    /**
     * @var int
     *
     * @ORM\Column(name="buyAmount", type="integer", nullable=true))
     */
    private $buyAmount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;
    
    /**
     * @ORM\OneToMany(targetEntity="Basket", mappedBy="item")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
	protected $basket;
	
	 /**
     * @ORM\Column(type="string")
     *
     * @Assert\File(mimeTypes={ "image/jpeg" })
     */
    private $photo;
	
	
	public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

	
	/**
	 * @ORM\Column(type="string")
	 *
	 * @Assert\NotBlank(message="Please, upload the product brochure as a PDF file.")
	 * @Assert\File(mimeTypes={ "image/jpeg" })
	 */
	private $photo;
	
	public function getPhoto()
	{
		return $this->photo;
	}
	
	public function setPhoto($photo)
	{
		$this->photo = $photo;
	
		return $this;
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
     * @return Item
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
     * Set price
     *
     * @param integer $price
     *
     * @return Item
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     *
     * @return Item
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set promotion
     *
     * @param string $promotion
     *
     * @return Item
     */
    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;

        return $this;
    }

    /**
     * Get promotion
     *
     * @return string
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * Set textPromotion
     *
     * @param string $textPromotion
     *
     * @return Item
     */
    public function setTextPromotion($textPromotion)
    {
        $this->textPromotion = $textPromotion;

        return $this;
    }

    /**
     * Get textPromotion
     *
     * @return string
     */
    public function getTextPromotion()
    {
        return $this->textPromotion;
    }

    /**
     * Set percentPromotion
     *
     * @param integer $percentPromotion
     *
     * @return Item
     */
    public function setPercentPromotion($percentPromotion)
    {
        $this->percentPromotion = $percentPromotion;

        return $this;
    }

    /**
     * Get percentPromotion
     *
     * @return int
     */
    public function getPercentPromotion()
    {
        return $this->percentPromotion;
    }

    /**
     * Set buyAmount
     *
     * @param integer $buyAmount
     *
     * @return Item
     */
    public function setBuyAmount($buyAmount)
    {
        $this->buyAmount = $buyAmount;

        return $this;
    }

    /**
     * Get buyAmount
     *
     * @return int
     */
    public function getBuyAmount()
    {
        return $this->buyAmount;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Item
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

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
     * Set basket
     *
     * @param \AppBundle\Entity\Basket $basket
     *
     * @return Item
     */
    public function setBasket(\AppBundle\Entity\Basket $basket = null)
    {
        $this->basket = $basket;

        return $this;
    }

    /**
     * Get basket
     *
     * @return \AppBundle\Entity\Basket
     */
    public function getBasket()
    {
        return $this->basket;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->basket = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add basket
     *
     * @param \AppBundle\Entity\Basket $basket
     *
     * @return Item
     */
    public function addBasket(\AppBundle\Entity\Basket $basket)
    {
        $this->basket[] = $basket;

        return $this;
    }

    /**
     * Remove basket
     *
     * @param \AppBundle\Entity\Basket $basket
     */
    public function removeBasket(\AppBundle\Entity\Basket $basket)
    {
        $this->basket->removeElement($basket);
    }
}
