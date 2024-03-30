<?php

namespace App\Validator;

use App\Repository\CouponCodeRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CouponCodeValidator extends ConstraintValidator
{
    public function __construct(
        private CouponCodeRepository $repository,
    ) {
    }

    public function validate($value, Constraint $constraint): void
    {
        /* @var CouponCode $constraint */

        if (null === $value || '' === $value) {
            return;
        }

        $couponCode = $this->repository->findOneBy(['code' => $value]);
        if ($couponCode) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
