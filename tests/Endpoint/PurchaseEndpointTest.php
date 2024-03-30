<?php

namespace App\Tests\Endpoint;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Repository\ProductRepository;

class PurchaseEndpointTest extends ApiTestCase
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
        $response = static::createClient()->request('POST', '/purchase', [
            'json' => [
                'product' => $this->productId,
                'taxNumber' => 'IT22222222222',
                'couponCode' => 'P10',
                'paymentProcessor' => 'paypal',
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'status' => 'success',
            'message' => 'Payment processed.',
        ]);
    }

    public function testValidDataWithoutCouponCode(): void
    {
        $response = static::createClient()->request('POST', '/purchase', [
            'json' => [
                'product' => $this->productId,
                'taxNumber' => 'IT22222222222',
                'paymentProcessor' => 'paypal',
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'status' => 'success',
            'message' => 'Payment processed.',
        ]);
    }

    public function testIvalidProductId(): void
    {
        $productId = $this->productId + 100000;
        $response = static::createClient()->request('POST', '/purchase', [
            'json' => [
                'product' => $productId,
                'taxNumber' => 'IT22222222222',
                'paymentProcessor' => 'paypal',
            ]
        ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertJsonContains(['detail' => "product: The product with id: \"$productId\" not found."]);
    }

    public function testInvalidTaxNumber(): void
    {
        $invalidTaxNumber = 'AA22222';
        $response = static::createClient()->request('POST', '/purchase', [
            'json' => [
                'product' => $this->productId,
                'taxNumber' => $invalidTaxNumber,
                'couponCode' => 'P10',
                'paymentProcessor' => 'paypal',
            ]
        ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertJsonContains(['detail' => "taxNumber: The taxNumber \"$invalidTaxNumber\" is not valid."]);
    }

    public function testInvalidCouponCode(): void
    {
        $invalidCouponCode = 'AA';
        $response = static::createClient()->request('POST', '/purchase', [
            'json' => [
                'product' => $this->productId,
                'taxNumber' => 'IT22222222222',
                'couponCode' => $invalidCouponCode,
                'paymentProcessor' => 'paypal',
            ]
        ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertJsonContains(['detail' => "couponCode: The coupon code \"$invalidCouponCode\" is not valid."]);
    }

    public function testInvalidPaymentProcessor(): void
    {
        $invalidPaymentProcessor = 'test';
        $response = static::createClient()->request('POST', '/purchase', [
            'json' => [
                'product' => $this->productId,
                'taxNumber' => 'IT22222222222',
                'couponCode' => 'P10',
                'paymentProcessor' => $invalidPaymentProcessor,
            ]
        ]);

        $this->assertResponseStatusCodeSame(400);
        $this->assertJsonContains(['detail' => "paymentProcessor: The payment processor \"$invalidPaymentProcessor\" is not valid."]);
    }
}
