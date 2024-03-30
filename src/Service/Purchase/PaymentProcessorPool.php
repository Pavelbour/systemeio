<?php

namespace App\Service\Purchase;


class PaymentProcessorPool
{
    private $pool = [];

    public function __construct(
        PaypalPaymentProcessor $paypalPaymentProcessor,
        StripePaymentProcessor $stripePaymentProcessor,
    ) {
        $this->pool['paypal'] = $paypalPaymentProcessor;
        $this->pool['stripe'] = $stripePaymentProcessor;
    }

    public function getPaymentProcessor(string $name): PaymentProcessor
    {
        return $this->pool[$name];
    }
}
