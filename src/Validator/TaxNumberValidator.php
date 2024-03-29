<?php

namespace App\Validator;

use App\Repository\TaxNumberValidatorRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TaxNumberValidator extends ConstraintValidator
{
    public function __construct(
        private TaxNumberValidatorRepository $repository,
    ) {
    }

    public function validate($value, Constraint $constraint): void
    {
        /* @var TaxNumber $constraint */
        if (null === $value || '' === $value) {
            return;
        }

        $countryCode = substr($value, 0, 2);
        $taxNumberValidator = $this->repository->findOneBy(['code' => $countryCode]);

        if ($taxNumberValidator && preg_match($taxNumberValidator->getRegex(), $value, $matches)) {
            return;
        }


        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
