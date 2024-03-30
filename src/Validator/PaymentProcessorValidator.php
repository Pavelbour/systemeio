<?php

namespace App\Validator;

use App\Service\Purchase\PaymentProcessorPool;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PaymentProcessorValidator extends ConstraintValidator
{
    public function __construct(
        private PaymentProcessorPool $pool,
    ) {
    }

    public function validate($value, Constraint $constraint): void
    {
        /* @var PaymentProcessor $constraint */

        if (null === $value || '' === $value) {
            return;
        }

        try {
            $this->pool->getPaymentProcessor($value);
        } catch(\Exception $e) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }

        return;
    }
}
