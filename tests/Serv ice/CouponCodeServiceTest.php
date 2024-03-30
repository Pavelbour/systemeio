<?php

namespace App\Tests\Service;

use App\Service\CouponCode\CouponCodeService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CouponCodeServiceTest extends KernelTestCase
{
    private  CouponCodeService $service;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->service = $container->get(CouponCodeService::class);

    }

    public static function couponCodeProvider(): array
    {
        return [
            [10000, 'P10', 9000],
            [10000, 'A5', 9995],
        ];
    }

    /**
     * @dataProvider couponCodeProvider
     */
    public function testValideCouponCode(int $price, string $couponCode, int $expected): void
    {
        $this->assertSame($expected, $this->service->getPrice($price, $couponCode));
    }

    public function testInvalidCouponCode(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Coupon code not found');
        $this->service->getPrice(10000, 'P100');
    }
}
