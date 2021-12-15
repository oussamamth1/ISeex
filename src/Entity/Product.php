<?php

namespace App\Entity;
use App\Entity\Category;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use App\Repository\ProductRepository;
use ApiPlatform\Core\Annotation\ApiResource;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\MimeType;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations
use Gedmo\Mapping\Driver\File as DriverFile;

/**
 * @ApiResource()
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
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3)
     */
    private $price;

    /**
     * @Vich\UploadableField(mapping="product", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
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
     */
    private $category;

    /**
     * @ORM\Column(type="datetime")
     *  @Gedmo\Timestampable(on="create")

     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="products")
     */
    private $publish;

    /**
     * @ORM\ManyToMany(targetEntity=Machine::class, mappedBy="article")
     */
    private $machines;

    /**
     * @ORM\Column(type="boolean")
     */
    private $StatusF;

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

    /**
     * @return Collection|Machine[]
     */
    public function getMachines(): Collection
    {
        return $this->machines;
    }

    public function addMachine(Machine $machine): self
    {
        if (!$this->machines->contains($machine)) {
            $this->machines[] = $machine;
            $machine->addArticle($this);
        }

        return $this;
    }

    public function removeMachine(Machine $machine): self
    {
        if ($this->machines->removeElement($machine)) {
            $machine->removeArticle($this);
        }

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
 
}