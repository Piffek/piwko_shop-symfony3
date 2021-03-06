<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Item
 *
 * @ORM\Table(name="item")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ItemRepository")
 * @Vich\Uploadable
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
     * @ORM\Column(name="kind", type="string", length=255)
     */
    private $kind;   
    

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
     * @ORM\Column(name="buyAmount", type="integer", nullable=true)
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
	 * @ORM\OneToMany(targetEntity="Rental", mappedBy="item")
	 * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
	 */
	protected $rental;
	
	/**
	 * One Cart has One Customer.
	 * @ORM\OneToOne(targetEntity="Rental", inversedBy="rentalItem")
	 * @ORM\JoinColumn(name="rentalId", referencedColumnName="id")
	 */
	protected $rentalId;
	
	/**
	 * @ORM\OneToMany(targetEntity="MiniatureImage", mappedBy="item")
	 * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
	 */
	protected $miniatureImage;
	
	/**
	 * 
	 * @ORM\OneToMany(targetEntity="FileToRental", mappedBy="item")
	 * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
	 */
	protected $fileToRental;



    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName", size="imageSize")
     * 
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->basket = new \Doctrine\Common\Collections\ArrayCollection();
		$this->rental= new \Doctrine\Common\Collections\ArrayCollection();
		$this->miniatureImage= new \Doctrine\Common\Collections\ArrayCollection();
		$this->fileToRental= new \Doctrine\Common\Collections\ArrayCollection();
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
    
    /**
     * Get rental
     *
     * @return integer
     */
    public function getRental()
    {
    	return $this->rental;
    }
    
    /**
     * Set rental
     *
     * @param integer $rental
     *
     * @return Item
     */
    public function setRental($rental)
    {
    	$this->rental = $rental;
    
    	return $this;
    }
    
    /**
     * Get kind
     *
     * @return string
     */
    public function getKind()
    {
    	return $this->kind;
    }
    
    /**
     * Set kind
     *
     * @param string $kind
     *
     * @return Item
     */
    public function setKind($kind)
    {
    	$this->kind = $kind;
    
    	return $this;
    }
	
	 /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Item
     */
    public function setImageFile(File $image = null){
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
        
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile(){
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     *
     * @return Item
     */
    public function setImageName($imageName){
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageName(){
        return $this->imageName;
    }
    

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Item
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add rental
     *
     * @param \AppBundle\Entity\Rental $rental
     *
     * @return Item
     */
    public function addRental(\AppBundle\Entity\Rental $rental)
    {
        $this->rental[] = $rental;

        return $this;
    }

    /**
     * Remove rental
     *
     * @param \AppBundle\Entity\Rental $rental
     */
    public function removeRental(\AppBundle\Entity\Rental $rental)
    {
        $this->rental->removeElement($rental);
    }

    /**
     * Set rentalId
     *
     * @param \AppBundle\Entity\Rental $rentalId
     *
     * @return Item
     */
    public function setRentalId(\AppBundle\Entity\Rental $rentalId = null)
    {
        $this->rentalId = $rentalId;

        return $this;
    }

    /**
     * Get rentalId
     *
     * @return \AppBundle\Entity\Rental
     */
    public function getRentalId()
    {
        return $this->rentalId;
    }

    /**
     * Add miniatureImage
     *
     * @param \AppBundle\Entity\MiniatureImage $miniatureImage
     *
     * @return Item
     */
    public function addMiniatureImage(\AppBundle\Entity\MiniatureImage $miniatureImage)
    {
        $this->miniatureImage[] = $miniatureImage;

        return $this;
    }

    /**
     * Remove miniatureImage
     *
     * @param \AppBundle\Entity\MiniatureImage $miniatureImage
     */
    public function removeMiniatureImage(\AppBundle\Entity\MiniatureImage $miniatureImage)
    {
        $this->miniatureImage->removeElement($miniatureImage);
    }

    /**
     * Get miniatureImage
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMiniatureImage()
    {
        return $this->miniatureImage;
    }
    

    /**
     * Add fileToRental
     *
     * @param \AppBundle\Entity\FileToRental $fileToRental
     *
     * @return Item
     */
    public function addFileToRental(\AppBundle\Entity\FileToRental $fileToRental)
    {
        $this->fileToRental[] = $fileToRental;

        return $this;
    }

    /**
     * Remove fileToRental
     *
     * @param \AppBundle\Entity\FileToRental $fileToRental
     */
    public function removeFileToRental(\AppBundle\Entity\FileToRental $fileToRental)
    {
        $this->fileToRental->removeElement($fileToRental);
    }

    /**
     * Get fileToRental
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFileToRental()
    {
        return $this->fileToRental;
    }
}
