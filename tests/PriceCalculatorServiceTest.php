<?php

namespace App\Tests;

use App\Service\PriceCalculator\PriceCalculatorService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PriceCalculatorServiceTest extends KernelTestCase
{
    private  PriceCalculatorService $service;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->service = $container->get(PriceCalculatorService::class);

    }

    public static function validDataProvider(): array
    {
        return [
            [10000, 'DE11111', 'P10', 10710],
            [10000, 'IT22222', '' , 12200],
        ];
    }

    /**
     * @dataProvider validDataProvider
     */
    public function testValidData(int $price, string $taxNumber, string $code, int $expected): void
    {
        $this->assertSame($expected, $this->service->calculatePrice($price, $taxNumber, $code));
    }

    public function testInvalidData(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Promocode not found');
        $this->expectExceptionMessage('Country code not found');
        $this->service->calculatePrice(10000, 'AA33333', 'AA');
    }
}
