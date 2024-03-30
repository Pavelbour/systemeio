<?php

namespace App\Tests\Validator;

use App\Kernel;
use App\Validator\TaxNumber;
use App\Validator\TaxNumberValidator;
use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class TaxNumberValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): ConstraintValidatorInterface
    {
        $kernel = new Kernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer()->get('test.service_container');
        return $container->get(TaxNumberValidator::class);
    }

    public function testValidTaxNumber(): void
    {
        $this->validator->validate('IT22222222222', new TaxNumber());
        $this->assertNoViolation();
    }

    
    public function testInvalidTaxNumber(): void
    {
        $constraint = new TaxNumber();
        $value = 'DE11';
        $this->validator->validate($value, $constraint);

        $this->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->assertRaised();
    }
}
