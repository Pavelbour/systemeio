<?php

namespace App\Service\PromoCode;

class PromoCodeProcessorPool
{
    private $pool = [];

    public function __construct(
        AbsolutePromoCodeProcessor $absolutePromoCodeProcessor,
        PercentPromoCodeProcessor $percentPromoCodeProcessor,
    )
    {
        $this->pool['A'] = $absolutePromoCodeProcessor;
        $this->pool['P'] = $percentPromoCodeProcessor;
    }

    public function getCodeProcessor(string $name): PromoCodeProcessor
    {
        return $this->pool[$name];
    }
}
