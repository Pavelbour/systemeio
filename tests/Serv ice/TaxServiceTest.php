<?php

namespace App\Tests\Service;

use App\Service\Tax\TaxService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TaxServiceTest extends KernelTestCase
{
    private TaxService $service;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->service = $container->get(TaxService::class);

    }

    public static function countryCodeProvider(): array
    {
        return [
            [10000, 'DE11111', 11900],
            [10000, 'IT22222', 12200],
        ];
    }

    /**
     * @dataProvider countryCodeProvider
     */
    public function testValidCountryCode(int $price, string $countryCode, int $expected): void
    {
        $this->assertSame($expected, $this->service->getPrice($price, $countryCode));
    }
    
    public function testInvalidCountryCode(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Country code not found');
        $this->service->getPrice(10000, 'AA');
    }
}
