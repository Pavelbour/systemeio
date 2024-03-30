<?php

namespace App\Service\CouponCode;

class PercentCouponCodeProcessor implements CouponCodeProcessor
{
    public function process (int $price, int $discount): int
    {
        return $price * (100 - $discount) / 100;
    }
}
