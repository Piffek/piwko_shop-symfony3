<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * MiniatureImage
 *
 * @ORM\Table(name="miniature_image")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MiniatureImageRepository")
 * @Vich\Uploadable
 */
class MiniatureImage
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
     * @ORM\ManyToOne(targetEntity="Item", inversedBy="miniatureImage")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
    protected $item;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="miniature_image", fileNameProperty="imageName")
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
    	$this->item = new \Doctrine\Common\Collections\ArrayCollection();
    
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
     * @param \AppBundle\Entity\Item $item
     *
     * @return Basket
     */
    public function setItem(\AppBundle\Entity\Item $item = null)
    {
    	$this->item = $item;
    
    	return $this;
    }
    
    /**
     * Get item
     *
     * @return \AppBundle\Entity\Item
     */
    public function getItem()
    {
    	return $this->item;
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
     * @return MiniatureImage
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
}
