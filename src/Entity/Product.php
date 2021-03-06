<?php

namespace App\Entity;
use App\Entity\Category;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\Collection;

use ApiPlatform\Core\Annotation\ApiResource;
use Gedmo\Mapping\Driver\File as DriverFile;

use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\MimeType;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations

/**
 * @ApiResource(
 *     collectionOperations={"get"={"normalization_context"={"groups"="conference:list"}}},
 *     itemOperations={"get"={"normalization_context"={"groups"="conference:item"}}},
 *     order={"category"="DESC", "publish"="ASC"},
 *    paginationEnabled=false)
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @Vich\Uploadable 
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     *
     * @ORM\Column(type="integer")
     * @Groups({"conference:list", "conference:item"})
     */
    
    private $id;


    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"conference:list", "conference:item"})
     */
    private $name;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3)
     * @Groups({"conference:list", "conference:item"})
     */
    private $price;

    /**
     * @Vich\UploadableField(mapping="product", fileNameProperty="image")
     * 
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"conference:list", "conference:item"})
     * @var string $image
     */
    private $image;




    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;
 
    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"conference:list", "conference:item"})
     */
    private $category;

    /**
     * @ORM\Column(type="datetime")
     *  @Gedmo\Timestampable(on="create")
     * 

     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="products")
     * @Groups({"conference:list", "conference:item"})
     */
    private $publish;

  

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"conference:list", "conference:item"})
     */
    private $StatusF;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="typeClient")
     * @Groups({"conference:list", "conference:item"})
     */
    private $client;

    public function __construct()
    {
        $this->machines = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

 

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    
    public function setImageFile(File $image = Null)
    {
        $this->imageFile = $image;
//test
        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getPublish(): ?User
    {
        return $this->publish;
    }

    public function setPublish(?User $publish): self
    {
        $this->publish = $publish;

        return $this;
    }

   
   

   
  
    public function __toString()
    {
        return $this->description;
    }

    public function getStatusF(): ?bool
    {
        return $this->StatusF;
    }

    public function setStatusF(bool $StatusF): self
    {
        $this->StatusF = $StatusF;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
 
}
