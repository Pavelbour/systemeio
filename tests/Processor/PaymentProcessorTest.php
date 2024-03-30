<?php

namespace App\Tests\Processor;

use App\Service\Purchase\PaymentProcessor;
use App\Service\Purchase\PaymentProcessorPool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PaymentProcessorTest extends KernelTestCase
{
    private PaymentProcessorPool $pool;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->pool = static::$kernel->getContainer()->get(PaymentProcessorPool::class);
    }

    public function testPaypalPaymentProcessor(): void
    {
        $paymentProcessor = $this->pool->getPaymentProcessor('paypal');

        $this->assertTrue($paymentProcessor->pay(12200));
        $this->assertFalse($paymentProcessor->pay(1000000));
    }

    public function testStripePaymentProcessor(): void
    {
        $paymentProcessor = $this->pool->getPaymentProcessor('stripe');

        $this->assertTrue($paymentProcessor->pay(12200));
        $this->assertFalse($paymentProcessor->pay(10));
    }

}
