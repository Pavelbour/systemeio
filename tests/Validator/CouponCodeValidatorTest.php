<?php

namespace App\Tests\Validator;

use App\Kernel;
use App\Validator\CouponCode;
use App\Validator\CouponCodeValidator;
use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class CouponCodeValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): ConstraintValidatorInterface
    {
        $kernel = new Kernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer()->get('test.service_container');
        return $container->get(CouponCodeValidator::class);
    }

    public function testValidCouponCode(): void
    {
        $this->validator->validate('P10', new CouponCode());
        $this->assertNoViolation();
    }

    public function testInvalidCouponCode(): void
    {
        $constraint = new CouponCode();
        $value = 'P50';
        $this->validator->validate($value, $constraint);

        $this->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->assertRaised();
    }
}
