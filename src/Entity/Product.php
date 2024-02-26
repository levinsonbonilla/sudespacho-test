<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?ValueAddedTax $valueAddedTax = null;

    #[ORM\Column(length: 150)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $basePrice = null;

    #[ORM\Column]
    private ?float $priceIncludingVat = null;

    #[ORM\ManyToOne]
    private ?User $createdBy = null;

    #[ORM\ManyToOne]
    private ?User $updatedBy = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    private ?bool $enabled = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValueAddedTax(): ?ValueAddedTax
    {
        return $this->valueAddedTax;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getBasePrice(): ?float
    {
        return $this->basePrice;
    }

    public function getPriceIncludingVat(): ?float
    {
        return $this->priceIncludingVat;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function isEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function add(
        ValueAddedTax $valueAddedTax,
        string $name,
        string $description,
        float $basePrice,
        float $priceIncludingVat,
        bool $enabled,
        User $user
    ) : Product
    {
        $this->valueAddedTax = $valueAddedTax;
        $this->name = $name;
        $this->description = $description;
        $this->basePrice = $basePrice;
        $this->priceIncludingVat = $priceIncludingVat;
        $this->createdBy = $user;
        $this->updatedBy = $user;
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
        $this->enabled = $enabled;
        return $this;
    }
}
