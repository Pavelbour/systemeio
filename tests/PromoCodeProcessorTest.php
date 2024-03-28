<?php

namespace App\Tests;

use App\Service\PromoCode\AbsolutePromoCodeProcessor;
use App\Service\PromoCode\PercentPromoCodeProcessor;
use PHPUnit\Framework\TestCase;

class PromoCodeProcessorTest extends TestCase
{
    public function testAbsolutePromoCodeProcessor(): void
    {
        $processor = new AbsolutePromoCodeProcessor();
        $this->assertSame(9990, $processor->process(10000, 10));
    }

    public function testPourcentPromoCodeProcessor(): void
    {
        $processor = new PercentPromoCodeProcessor();
        $this->assertSame(7500, $processor->process(10000, 25));
    }
}
