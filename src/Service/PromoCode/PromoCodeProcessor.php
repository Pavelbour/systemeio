<?php

namespace App\Service\PromoCode;

interface PromoCodeProcessor
{
    public function process(int $price, int $discount): int;
}
