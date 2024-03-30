<?php

namespace App\Service\CouponCode;

class AbsoluteCouponCodeProcessor implements CouponCodeProcessor
{
    public function process(int $price, int $discount): int
    {
        return $price - $discount;
    }
}
