<?php

namespace App\Service\PromoCode;

class AbsolutePromoCodeProcessor implements PromoCodeProcessor
{
    public function process(int $price, int $discount): int
    {
        return $price - $discount;
    }
}
