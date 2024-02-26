<?php

namespace App\Entity;

use App\Repository\ValueAddedTaxRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ValueAddedTaxRepository::class)]
class ValueAddedTax
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $percentage = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    private ?bool $enabled = null;

    #[ORM\OneToMany(targetEntity: Product::class, mappedBy: 'valueAddedTax')]
    private Collection $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPercentage(): ?float
    {
        return $this->percentage;
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

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function add(float $percentage, bool $enabled) : ValueAddedTax
    {
        $this->percentage = $percentage;
        $this->enabled = $enabled;
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();

        return $this;
    }

}
