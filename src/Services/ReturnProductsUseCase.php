<?php

namespace App\Services;

use App\Exception\ResponseException;
use App\Interface\ProductsFiltersInterface;
use App\Interface\ReturnProductsInterface;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class ReturnProductsUseCase implements ReturnProductsInterface
{
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly RequestStack $request,
        private readonly ProductsFiltersInterface $productsFilters
    ) {
        $request = $this->request->getCurrentRequest();
        $name = $request->get('name',null);
        $page = $request->get("page", 1)??1;
        $maxResults = $request->get("maxResults", 10);
        
        $this->productsFilters->addFilters(
            empty($page) ? 1 : $page,
            empty($maxResults) ? 10 : $maxResults,
            empty($name) ? null : $name 
        );
    }

    public function products() : array 
    {
        $rows = $this->productRepository->getPages($this->productsFilters);
        $pages = $this->numberPages($rows);

        if ($this->productsFilters->getPage() > $pages) {
            throw new ResponseException("The requested page number exceeds the allowed number.", 400);            
        }
        
        $data = $this->productRepository->findProducts($this->productsFilters);
        return array_merge([
            "data"=>$data, 
            "numberPages" => $pages,
            "currenPage"=>$this->productsFilters->getPage()
        ]);
    }   

    private function numberPages(array $rows) : int
    {
        return ceil($rows["numberRows"] / $this->productsFilters->getMaxResults());
    }

}
