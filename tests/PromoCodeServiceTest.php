<?php

namespace App\Tests;

use App\Service\PromoCode\PromoCodeService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PromoCodeServiceTest extends KernelTestCase
{
    private  PromoCodeService $service;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->service = $container->get(PromoCodeService::class);

    }

    public static function promoCodeProvider(): array
    {
        return [
            [10000, 'P10', 9000],
            [10000, 'A5', 9995],
        ];
    }

    /**
     * @dataProvider promoCodeProvider
     */
    public function testValidePromoCode(int $price, string $promoCode, int $expected): void
    {
        $this->assertSame($expected, $this->service->getPrice($price, $promoCode));
    }

    public function testInvalidPromocode(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Promocode not found');
        $this->service->getPrice(10000, 'P100');
    }
}
