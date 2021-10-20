<?php

namespace App\Entity;

use App\Repository\PostRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
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
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private $content;

    /**
     * @ORM\Column(type="date")
     */
    private $created_date;

    /**
     * @ORM\Column(type="date")
     */
    private $obsoleted_date;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank
     */
    private $keyword;

    /**
     * @ORM\ManyToOne(targetEntity=Context::class, inversedBy="post")
     * @ORM\JoinColumn(nullable=false)
     */
    private $context;

    public function __construct($tile, $content, $created_date) {
        $this->title = $tile;
        $this->content = $content;
        $this->created_date = $created_date;
    }

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->created_date;
    }

    public function setCreatedDate(\DateTimeInterface $created_date): self
    {
        $this->created_date = $created_date;

        return $this;
    }

    public function getObsoletedDate(): ?\DateTimeInterface
    {
        return $this->obsoleted_date;
    }

    public function setObsoletedDate(\DateTimeInterface $obsoleted_date): self
    {
        $obsoleted_date = new DateTime();
        $obsoleted_date->modify('+6 month');
        $this->obsoleted_date = $obsoleted_date;
        return $this;
    }

    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    public function setKeyword(?string $keyword): self
    {
        $this->keyword = $keyword;

        return $this;
    }

    public function getContext(): ?Context
    {
        return $this->context;
    }

    public function setContext(?Context $context): self
    {
        $this->context = $context;

        return $this;
    }
}
