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
    private int $id;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ValueAddedTax $valueAddedTax;

    #[ORM\Column(length: 150)]
    private string $name;

    #[ORM\Column(length: 255)]
    private string $description;

    #[ORM\Column]
    private float $basePrice;

    #[ORM\Column]
    private float $priceIncludingVat;

    #[ORM\ManyToOne]
    private User $createdBy;

    #[ORM\ManyToOne]
    private User $updatedBy;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column]
    private \DateTimeImmutable $updatedAt;

    #[ORM\Column]
    private bool $enabled;

    public function getId(): int
    {
        return $this->id;
    }

    public function getValueAddedTax(): ValueAddedTax
    {
        return $this->valueAddedTax;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getBasePrice(): float
    {
        return $this->basePrice;
    }

    public function getPriceIncludingVat(): float
    {
        return $this->priceIncludingVat;
    }

    public function getCreatedBy(): User
    {
        return $this->createdBy;
    }

    public function getUpdatedBy(): User
    {
        return $this->updatedBy;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function isEnabled(): bool
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
