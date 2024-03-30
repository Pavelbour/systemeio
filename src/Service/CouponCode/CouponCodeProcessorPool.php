<?php

namespace App\Service\CouponCode;

class CouponCodeProcessorPool
{
    private $pool = [];

    public function __construct(
        AbsoluteCouponCodeProcessor $absoluteCouponCodeProcessor,
        PercentCouponCodeProcessor $percentCouponCodeProcessor,
    )
    {
        $this->pool['A'] = $absoluteCouponCodeProcessor;
        $this->pool['P'] = $percentCouponCodeProcessor;
    }

    public function getCodeProcessor(string $name): CouponCodeProcessor
    {
        return $this->pool[$name];
    }
}
