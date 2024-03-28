<?php

namespace App\Service\PriceCalculator;

use App\DTO\CalculatePriceRequestDto;
use App\Repository\ProductRepository;
use App\Service\PromoCode\PromoCodeService;
use App\Service\Tax\TaxService;

class PriceCalculatorService
{
    public function __construct(
        private PromoCodeService $promoCodeService,
        private TaxService $taxService,
        private ProductRepository $productRepository,
    ) {
    }

    public function calculateProductPrice(CalculatePriceRequestDto $dto): int
    {
        $product = $this->productRepository->find($dto->getProduct());
        if (!$product) {
            throw new \Exception('Product not found.');
        }

        return $this->calculatePrice($product->getPrice(), $dto->getTaxNumber(), $dto->getCouponCode());
    }

    private function calculatePrice(int $price, string $taxNumber, string $code = ''): int
    {
        $errors =[];

        if ($code) {
            try {
                $price = $this->promoCodeService->getPrice($price, $code); 
            } catch (\Exception $e) {
                $errors[] = $e->getMessage();
            }
        }

        try {
            $price = $this->taxService->getPrice($price, $taxNumber);
        } catch (\Exception $e) {
            $errors[] = $e->getMessage();
        }

        if (sizeof($errors) > 0) {
            throw new \Exception(json_encode($errors));
        }

        return $price;
    }
}
