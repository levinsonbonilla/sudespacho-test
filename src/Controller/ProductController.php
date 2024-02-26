<?php

namespace App\Controller;

use App\Exception\ResponseException;
use App\Interface\AddProductInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class ProductController extends AbstractController
{
    #[Route('/product', name: 'product_add', methods:["POST"])]
    public function index(AddProductInterface $addProduct): Response
    {
        try {
            $addProduct->addProducts();
            $data = [
                "status" => "Success",
                "message" => "Success"
            ];
        } catch (\Throwable $th) {
            $data = [
                "status" => "Error",
                "message" => "An error occurred, please contact the administrator."
            ];
            $code = 500;
        } catch (ResponseException $re)
        {
            $data = [
                "status" => "error", 
                "message"=> $re->getMessage()
            ];
            $code = $re->getStatusCode();
        }

        return $this->json($data, $code);
    }
}
