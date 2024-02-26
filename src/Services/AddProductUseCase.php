<?php

namespace App\Services;

use App\Entity\{Product,ValueAddedTax};
use App\Exception\ResponseException;
use App\Interface\AddProductInterface;
use App\Repository\{ProductRepository,ValueAddedTaxRepository};
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

class AddProductUseCase implements AddProductInterface
{
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly ValueAddedTaxRepository $valueAddedTaxRepository,
        private readonly RequestStack $request,
        private readonly Security $security
    ) {

    }

    public function addProducts() : void 
    {
        $data = json_decode($this->request->getCurrentRequest()->getContent(), true);
        $totalRows = count($data);

        foreach ($data as $key => $value) {
            $product = new Product();
            $valueAddedTax = $this->valueAddedTax((int) $value["valueAddedTaxId"]);

            if (empty($valueAddedTax)) {
                throw new ResponseException("valueAddedTaxId does not exist", 400);                
            }

            $product->add(
                $valueAddedTax,
                $value["name"],
                $value["description"],
                $value["price"],
                $this->priceIncludingVat((float) $value["price"], $valueAddedTax),
                $value["enabled"],
                $this->security->getUser()
            );
            
            $this->productRepository->add(
                $product,
                $totalRows == ($key + 1) ? true : false 
            );
        }
    }


    private function valueAddedTax(int $valueAddedTaxId) : ?ValueAddedTax
    {
        return $this->valueAddedTaxRepository->find($valueAddedTaxId);
    }

    private function priceIncludingVat(float $price, ValueAddedTax $valueAddedTax) : float
    {        
        return $price * (1 + ($valueAddedTax->getPercentage() / 100));
    }
}
