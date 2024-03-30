<?php

namespace App\Tests\Validator;

use App\Kernel;
use App\Validator\PaymentProcessor;
use App\Validator\PaymentProcessorValidator;
use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class PaymentProcessorValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): ConstraintValidatorInterface
    {
        $kernel = new Kernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer()->get('test.service_container');
        return $container->get(PaymentProcessorValidator::class);
    }

    public function testValidPaymentProcessorName(): void
    {
        $this->validator->validate('paypal', new PaymentProcessor());
        $this->assertNoViolation();
    }

    public function testInvalidPaymentProcessorName(): void
    {
        $constraint = new PaymentProcessor();
        $value = 'test';
        $this->validator->validate($value, $constraint);

        $this->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->assertRaised();
    }
}
