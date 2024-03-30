<?php

namespace App\Service\Purchase;

use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor as Processor;

class PaypalPaymentProcessor implements PaymentProcessor
{
    private Processor $processor;

    public function __construct(Processor $processor)
    {
        $this->processor = $processor;
    }

    public function pay(int $amount): bool
    {
        try {
            $this->processor->pay($amount);
        } catch(\Exception $e) {
            return false;
        }

        return true;
    }
}
