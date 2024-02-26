<?php

namespace App\Controller;

use App\Interface\GetValueAddedTaxInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class ValueAddedTaxController extends AbstractController
{
    #[Route('/value/added/tax', name: 'app_value_added_tax', methods: ["GET"])]
    public function index(
        GetValueAddedTaxInterface $getValueAddedTaxInterface
    ): Response {
        try {
            $data = ["status"=>"Succes","data"=> $getValueAddedTaxInterface->getValue()];
            $code = 200;
        } catch (\Throwable $th) {
            $data = [
                "status" => "Error",
                "message" => "An error occurred, please contact the administrator.",
                "data"=>[]
            ];
            $code = 500;
        }

        return $this->json($data, $code);
    }
}
