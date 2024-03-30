<?php

namespace App\Tests\Processor;

use App\Service\CouponCode\AbsoluteCouponCodeProcessor;
use App\Service\CouponCode\PercentCouponCodeProcessor;
use PHPUnit\Framework\TestCase;

class CouponCodeProcessorTest extends TestCase
{
    public function testAbsoluteCouponCodeProcessor(): void
    {
        $processor = new AbsoluteCouponCodeProcessor();
        $this->assertSame(9990, $processor->process(10000, 10));
    }

    public function testPourcentCouponCodeProcessor(): void
    {
        $processor = new PercentCouponCodeProcessor();
        $this->assertSame(7500, $processor->process(10000, 25));
    }
}
