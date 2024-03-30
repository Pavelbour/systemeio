<?php

namespace App\DTO;

use App\Validator as CustomAssert;;
use Symfony\Component\Validator\Constraints as Assert;

class PurchaseRequestDto
{
    #[Assert\NotBlank()]
    #[Assert\Type('integer')]
    #[CustomAssert\ProductId()]
    private int $product;

    #[Assert\NotBlank()]
    #[Assert\Type('string')]
    #[Assert\Regex('/^[A-Z]{2}/')]
    #[CustomAssert\TaxNumber()]
    private string $taxNumber;

    #[Assert\Type('string')]
    #[Assert\Regex('/^[A-Z]{1}/')]
    #[CustomAssert\CouponCode()]
    private ?string $couponCode;

    #[Assert\NotBlank()]
    #[Assert\Type('string')]
    #[CustomAssert\PaymentProcessor()]
    private string $paymentProcessor;

    public function setProduct(int $product): void
    {
        $this->product = $product;
    }

    public function getProduct(): int
    {
        return $this->product;
    }

    public function setTaxNumber(string $taxNumber): void
    {
        $this->taxNumber = $taxNumber;
    }

    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }

    public function setCouponCode(string $couponCode): void
    {
        $this->couponCode = $couponCode;
    }

    public function getCouponCode(): string
    {
        return $this->couponCode ?? '';
    }

    public function setPaymentProcessor(string $paymentProcessor): void
    {
        $this->paymentProcessor = $paymentProcessor;
    }

    public function getPaymentProcessor(): string
    {
        return $this->paymentProcessor;
    }
}