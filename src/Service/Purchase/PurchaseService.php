<?php

namespace App\Service\Purchase;

use App\DTO\CalculatePriceRequestDto;
use App\DTO\PurchaseRequestDto;
use App\Service\PriceCalculator\PriceCalculatorService;

class PurchaseService
{
    public function __construct(
        private PriceCalculatorService $service,
        private PaymentProcessorPool $pool,
    ) {
    }

    public function processPayment(PurchaseRequestDto $dto): void
    {
        $priceDto = new CalculatePriceRequestDto();
        $priceDto->setProduct($dto->getProduct());
        $priceDto->setTaxNumber($dto->getTaxNumber());
        $priceDto->setCouponCode($dto->getCouponCode());

        $price = $this->service->calculateProductPrice($priceDto);

        $processor = $this->pool->getPaymentProcessor($dto->getPaymentProcessor());
        $result = $processor->pay($price);
        if (!$result) {
            throw new \Exception('Payment processing error.');
        }
    }
}
