<?php

namespace App\Service\CouponCode;

use App\Repository\CouponCodeRepository;

class CouponCodeService
{

    public function __construct(
        private CouponCodeRepository $couponCodeRepository,
        private CouponCodeProcessorPool $pool,
    ) {
    }

    public function getPrice(int $price, string $code): int
    {
        $couponCode = $this->couponCodeRepository->findOneBy(['code' => $code]);

        if (!$couponCode) {
            throw new \Exception('Coupon code not found.');
        }

        $processor = $this->pool->getCodeProcessor($this->getCodeType($couponCode->getCode()));

        return $processor->process($price, $this->getCodeValue($couponCode->getCode()));
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
