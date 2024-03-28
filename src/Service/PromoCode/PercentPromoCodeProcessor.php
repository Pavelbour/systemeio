<?php

namespace App\Service\PromoCode;

class PercentPromoCodeProcessor implements PromoCodeProcessor
{
    public function process (int $price, int $discount): int
    {
        return $price * (100 - $discount) / 100;
    }
}
