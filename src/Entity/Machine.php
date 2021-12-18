<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MachineRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MachineRepository::class)
 *  @UniqueEntity("referonce")
 */
class Machine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $referonce;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, inversedBy="machines")
     */
    private $article;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Marque;

    public function __construct()
    {
        $this->article = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReferonce(): ?string
    {
        return $this->referonce;
    }

    public function setReferonce(string $referonce): self
    {
        $this->referonce = $referonce;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getArticle(): Collection
    {
        return $this->article;
    }

    public function addArticle(Product $article): self
    {
        if (!$this->article->contains($article)) {
            $this->article[] = $article;
        }

        return $this;
    }

    public function removeArticle(Product $article): self
    {
        $this->article->removeElement($article);

        return $this;
    }

    public function __toString()
    {
        return $this->referonce;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->Marque;
    }

    public function setMarque(string $Marque): self
    {
        $this->Marque = $Marque;

        return $this;
    }
 
}
