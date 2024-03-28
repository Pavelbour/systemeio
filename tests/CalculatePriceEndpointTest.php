<?php

namespace App\Tests;

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

    public function testValidData(): void
    {
        $response = static::createClient()->request('POST', '/calculate-price', [
            'json' => [
                'product' => $this->productId,
                'taxNumber' => 'IT22222',
                'couponCode' => 'P10',
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'status' => 'success',
            'price' => 10980,
        ]);
    }

    public function testInvalidData(): void
    {
        $response = static::createClient()->request('POST', '/calculate-price', [
            'json' => [
                'product' => $this->productId,
                'taxNumber' => 'AA22222',
                'couponCode' => 'AA',
            ],
        ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertJsonContains([
            'status' => 'error',
            'messages' => [
                'Promocode not found.',
                'Country code not found.'
            ],
        ]);
    }

    public function testInvalidProductId(): void
    {
        $response = static::createClient()->request('POST', '/calculate-price', [
            'json' => [
                'product' => 999999,
                'taxNumber' => 'AA22222',
                'couponCode' => 'AA',
            ],
        ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertJsonContains([
            'status' => 'error',
            'messages' => 'Product not found.',
        ]);
    }
}
