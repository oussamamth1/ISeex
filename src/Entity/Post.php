<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PostRepository;

use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 * @ApiResource()
 */
class Post
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
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="posts")
     */
    private $userpost;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getUserpost(): ?User
    {
        return $this->userpost;
    }

    public function setUserpost(?User $userpost): self
    {
        $this->userpost = $userpost;

        return $this;
    }
    public function __toString1()
    {
        return $this->getUserpost();
    }
    public function __toString(): string
    {
        return $this->__toString1();
    }

 
}
