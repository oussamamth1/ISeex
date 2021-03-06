<?php

namespace App\Entity;

use App\Entity\Product;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoryRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;

/**
 * @ApiResource()
 * 
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 * @ApiFilter(DateFilter::class, properties={"label":"ipartial","id":"exact"})
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"conference:list", "conference:item"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups({"conference:list", "conference:item"})
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="category")
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setCategory($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getCategory() === $this) {
                $product->setCategory(null);
            }
        }

        return $this;
    }
   
    public function __toString()
    {
        return $this->label;
    }
}
