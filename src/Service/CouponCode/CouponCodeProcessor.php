<?php

namespace App\Service\CouponCode;

interface CouponCodeProcessor
{
    public function process(int $price, int $discount): int;
}
