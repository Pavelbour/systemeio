<?php

namespace App\Validator;

use App\Repository\PromoCodeRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CouponCodeValidator extends ConstraintValidator
{
    public function __construct(
        private PromoCodeRepository $repository,
    ) {
    }

    public function validate($value, Constraint $constraint): void
    {
        /* @var CouponCode $constraint */

        if (null === $value || '' === $value) {
            return;
        }

        $promoCode = $this->repository->findOneBy(['code' => $value]);
        if ($promoCode) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
