<?php

namespace App\Tests\Validator;

use App\Kernel;
use App\Repository\ProductRepository;
use App\Validator\ProductId;
use App\Validator\ProductIdValidator;
use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class ProductIdValidatorTest extends ConstraintValidatorTestCase
{
    private int $validProductId;

    protected function createValidator(): ConstraintValidatorInterface
    {
        $kernel = new Kernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer()->get('test.service_container');

        $this->validProductId = $container->get(ProductRepository::class)
            ->findOneBy(['name' => 'Iphone'])
            ->getId();

        return $container->get(ProductIdValidator::class);
    }

    public function testValidProductId(): void
    {
        $this->validator->validate($this->validProductId, new ProductId());
        $this->assertNoViolation();
    }

    public function testInvalidProductId(): void
    {
        $invalidProductId = $this->validProductId + 100000;
        $constraint = new ProductId();
        $this->validator->validate($invalidProductId, $constraint);

        $this->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $invalidProductId)
            ->assertRaised();
    }
}
