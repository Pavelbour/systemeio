<?php

namespace App\Service\Purchase;

interface PaymentProcessor
{
    public function pay(int $amount): bool;
}
