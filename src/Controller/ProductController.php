<?php

namespace App\Controller;

use App\Exception\ResponseException;
use App\Interface\AddProductInterface;
use App\Interface\ReturnProductsInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/product', name: 'api_')]
class ProductController extends AbstractController
{
    #[Route('', name: 'product_add', methods: ["POST"])]
    public function addProducts(AddProductInterface $addProduct): Response
    {
        try {
            $addProduct->addProducts();
            $data = [
                "status" => "Success",
                "message" => "Success"
            ];
            $code = 202;
        }  catch (ResponseException $re) {
            $data = [
                "status" => "error",
                "message" => $re->getMessage()
            ];
            $code = $re->getStatusCode();
        } catch (\Throwable $th) {
            $data = [
                "status" => "Error",
                "message" => "An error occurred, please contact the administrator."
            ];
            $code = 500;
        }

        return $this->json($data, $code);
    }

    #[Route('', name: 'product', methods: ["GET"])]
    public function products(ReturnProductsInterface $returnProducts): Response
    {        
        try {
            $data = $returnProducts->products();
            $code = 200;
        } catch (ResponseException $re) {
            $data = [
                "message" => $re->getMessage(),
                "data" => [],
                "numberPages" => 0,
                "currenPage" => 0
            ];
            $code = $re->getStatusCode();
        } catch (\Throwable $th) {
            $data = [
                "status" => "Error",
                "message" => "An error occurred, please contact the administrator."
            ];
            $code = 500;
        }
        
        return $this->json($data, $code);
    }
}
