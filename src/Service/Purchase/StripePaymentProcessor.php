<?php

namespace App\Service\Purchase;

use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor as Processor;

class StripePaymentProcessor implements PaymentProcessor
{
    private Processor $processor;

    public function __construct(Processor $processor)
    {
        $this->processor = $processor;
    }

    public function pay(int $amount): bool
    {

        return $this->processor->processPayment($amount);
    }
}
