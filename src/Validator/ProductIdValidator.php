<?php

namespace App\Validator;

use App\Repository\ProductRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ProductIdValidator extends ConstraintValidator
{
    public function __construct(
        private ProductRepository $repository,
    ) {
    }

    public function validate($value, Constraint $constraint): void
    {
        /* @var ProductId $constraint */

        if (null === $value || '' === $value) {
            return;
        }

        
        $product = $this->repository->find($value);
        if ($product) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
