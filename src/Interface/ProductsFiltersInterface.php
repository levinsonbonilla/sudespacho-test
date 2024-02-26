<?php

namespace App\Interface;


interface ProductsFiltersInterface
{
    public function addFilters(
        ?int $page = 1,
        ?int $maxResults = 10,
        ?string $name = null
    ): void;

    public function getName(): ?string;

    public function getPage(): int;

    public function getMaxResults(): int;

    public function initialRow() : int;
}
