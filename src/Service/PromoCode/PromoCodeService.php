<?php

namespace App\Service\PromoCode;

use App\Repository\PromoCodeRepository;

class PromoCodeService
{

    public function __construct(
        private PromoCodeRepository $promoCodeRepository,
        private PromoCodeProcessorPool $pool,
    ) {
    }

    public function getPrice(int $price, string $code): int
    {
        $promoCode = $this->promoCodeRepository->findOneBy(['code' => $code]);

        if (!$promoCode) {
            throw new \Exception('Promocode not found.');
        }

        $processor = $this->pool->getCodeProcessor($this->getCodeType($promoCode->getCode()));

        return $processor->process($price, $this->getCodeValue($promoCode->getCode()));
    }

    private function getCodeValue(string $code): string
    {
        return substr($code, 1);
    }

    private function getCodeType(string $code): string
    {
        return substr($code, 0, 1);
    }
}
