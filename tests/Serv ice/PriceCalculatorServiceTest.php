<?php

namespace App\Tests\Service;

use App\DTO\CalculatePriceRequestDto;
use App\Repository\ProductRepository;
use App\Service\PriceCalculator\PriceCalculatorService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PriceCalculatorServiceTest extends KernelTestCase
{
    private  PriceCalculatorService $service;
    private CalculatePriceRequestDto $dto;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->service = $container->get(PriceCalculatorService::class);

        $repository = $container->get(ProductRepository::class);
        $product = $repository->findOneBy(['name' => 'Iphone']);

        $this->dto = new CalculatePriceRequestDto();
        $this->dto->setProduct($product->getId());
    }
    
    public function testValidData(): void
    {
        $this->dto->setTaxNumber('DE11111');
        $this->dto->setCouponCode('P10');
        $this->assertSame(10710, $this->service->calculateProductPrice($this->dto));

        $this->dto->setTaxNumber(('IT22222'));
        $this->dto->setCouponCode('');
        $this->assertSame(12200, $this->service->calculateProductPrice($this->dto));
    }

    public function testInvalidData(): void
    {
        $this->dto->setTaxNumber('AA33333');
        $this->dto->setCouponCode('AA');

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Coupon code not found');
        $this->expectExceptionMessage('Country code not found');
        $this->service->calculateProductPrice($this->dto);
    }

    public function testInvalidProductId(): void
    {
        $this->dto->setProduct(999999);
        $this->dto->setTaxNumber('AA33333');
        $this->dto->setCouponCode('AA');

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Product not found');
        $this->service->calculateProductPrice($this->dto);
    }
}
