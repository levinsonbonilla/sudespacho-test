<?php

namespace App\Tests\unit;

use App\Repository\ValueAddedTaxRepository;
use App\Services\GetValueAddedTaxUseCase;
use PHPUnit\Framework\TestCase;

class GetValueAddedTaxUseCaseTest extends TestCase
{
    public function testValueAddedTax(): void
    {
        $repository = $this->createMock(ValueAddedTaxRepository::class);
        $expectedValue = ['status' => "Succes"];
        $repository->expects($this->once())
            ->method('getValueAddedTaxActive')
            ->willReturn($expectedValue);

        $useCase = new GetValueAddedTaxUseCase($repository);

        $result = $useCase->getValue();

        $this->assertIsArray($result);
        $this->assertTrue(true);
    }
}
