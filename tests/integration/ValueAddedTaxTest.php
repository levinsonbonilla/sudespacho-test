<?php

namespace App\Tests\integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ValueAddedTaxTest extends WebTestCase
{
    public function testUnauthorized(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/value/added/tax');

        $this->assertEquals(401,$client->getResponse()->getStatusCode());
    }

    public function testSuccess(): void
    {
        $client = static::createClient();

        /**
         * test a login_check an get token 
         */
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
        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getContent(), true);
        $token = $data['token'];
        $this->assertArrayHasKey('token', $data);
        
        /**
         * Test a value added tax
         */
        $client->request('GET', '/api/value/added/tax', [], [], ['HTTP_AUTHORIZATION' => "Bearer $token"]);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


}
