<?php

namespace App\Utils;

use App\Interface\ProductsFiltersInterface;

class productsFilters implements ProductsFiltersInterface
{
    private ?string $name;
    private int $page;
    private int $maxResults;

    public function addFilters(
        ?int $page = 1,
        ?int $maxResults = 10,
        ?string $name = null
    ) : void 
    {
        $this->name = $name;
        $this->page = $page;
        $this->maxResults = $maxResults;
    } 

    public function getName() : ?string
    {
        return $this->name;
    }

    public function initialRow() : int
    {
        return ($this->page-1) * $this->maxResults;
    }

    public function getPage() : int
    {
        return $this->page;
    }

    public function getMaxResults() : int
    {
        return $this->maxResults;
    }
}
