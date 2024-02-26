<?php

namespace App\Tests\integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductTest extends WebTestCase
{
    public function login(): array
    {
        $client = static::createClient();
        $username = 'test@gmail.com';
        $password = 'apiAdmin2022*';
        $payload = json_encode(['username' => $username, 'password' => $password]);

        $client->request('POST', '/api/login_check', 
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            $payload
        );

        $response = $client->getResponse();

        $data = json_decode($response->getContent(), true);
        return ["client"=>$client, "token" => $data['token']];
    }

    public function testUnauthorizedGet(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/product');

        $this->assertEquals(401,$client->getResponse()->getStatusCode());
    }

    public function testUnauthorizedPost(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/product');

        $this->assertEquals(401,$client->getResponse()->getStatusCode());
    }    

    public function testSuccessPost(): void
    {
        $login = $this->login();
        $client = $login["client"];
        $token = $login["token"];
        
        $payload = json_encode(
            [
                [
                    "valueAddedTaxId" => 1,
                    "name" => "desk",
                    "description" => "Desk to home office",
                    "price" => 200,
                    "enabled" => 1
                ],
                [
                    "valueAddedTaxId" => 2,
                    "name" => "PC gamer",
                    "description" => "PC to comunity gamer with high performance",
                    "price" => 100,
                    "enabled" => 1
                ],
                [
                    "valueAddedTaxId" => 3,
                    "name" => "mouse gamer",
                    "description" => "Mouse with high quality and fast",
                    "price" => 50,
                    "enabled" => 1
                ]
            ]
        );
        $client->request(
            'POST', 
            '/api/product', 
            [], 
            [], 
            ['HTTP_AUTHORIZATION' => "Bearer $token"],
            $payload
        );
        
        $this->assertEquals(202, $client->getResponse()->getStatusCode());
    }

    public function testSuccessGet(): void
    {
        $login = $this->login();
        $client = $login["client"];
        $token = $login["token"];

        $client->request(
            'GET', 
            '/api/product', 
            [], 
            [], 
            ['HTTP_AUTHORIZATION' => "Bearer $token"]);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}
