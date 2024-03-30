<?php

namespace App\Tests\Endpoint;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Repository\ProductRepository;

class CalculatePriceEndpointTest extends ApiTestCase
{
    private int $productId;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $repository = $container->get(ProductRepository::class);
        $product = $repository->findOneBy(['name' => 'Iphone']);
        $this->productId = $product->getId();
    }

    public function testValidDataWithCouponCode(): void
    {
        $response = static::createClient()->request('POST', '/calculate-price', [
            'json' => [
                'product' => $this->productId,
                'taxNumber' => 'IT22222222222',
                'couponCode' => 'P10',
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'status' => 'success',
            'price' => 10980,
        ]);
    }

    public function testValidDataWithoutCouponCode(): void
    {
        $response = static::createClient()->request('POST', '/calculate-price', [
            'json' => [
                'product' => $this->productId,
                'taxNumber' => 'IT22222222222',
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'status' => 'success',
            'price' => 12200,
        ]);
    }

    public function testInvalidTaxNumber(): void
    {
        $invalidTaxNumber = 'AA22222';
        $response = static::createClient()->request('POST', '/calculate-price', [
            'json' => [
                'product' => $this->productId,
                'taxNumber' => $invalidTaxNumber,
                'couponCode' => 'P10',
            ],
        ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertJsonContains(['detail' => "taxNumber: The taxNumber \"$invalidTaxNumber\" is not valid."]);
    }

    public function testInvalidCouponCode(): void
    {
        $invalidCouponCode = 'AA';
        $response = static::createClient()->request('POST', '/calculate-price', [
            'json' => [
                'product' => $this->productId,
                'taxNumber' => 'IT22222222222',
                'couponCode' => $invalidCouponCode,
            ],
        ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertJsonContains(['detail' => "couponCode: The coupon code \"$invalidCouponCode\" is not valid."]);
    }

    public function testInvalidProductId(): void
    {
        $productId = $this->productId + 10000;
        $response = static::createClient()->request('POST', '/calculate-price', [
            'json' => [
                'product' => $productId,
                'taxNumber' => 'IT22222222222',
                'couponCode' => 'P10',
            ],
        ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertJsonContains(['detail' => "product: The product with id: \"$productId\" not found."]);
    }
}
