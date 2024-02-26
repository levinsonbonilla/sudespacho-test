<?php

namespace App\Services;

use App\Repository\ValueAddedTaxRepository;
use App\Interface\GetValueAddedTaxInterface;

class GetValueAddedTaxUseCase implements GetValueAddedTaxInterface
{
    public function __construct(private readonly ValueAddedTaxRepository $valueAddedTaxRepository ) {

    }

    public function getValue() : array 
    {
        return $this->valueAddedTaxRepository->getValueAddedTaxActive();
    }    
}
