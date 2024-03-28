<?php

namespace App\Service\Tax;

use App\Repository\TaxValueRepository;
use Exception;

class TaxService
{
    public function __construct(
        private TaxValueRepository $taxValueRepository,
    ) {       
    }

    public function getPrice(int $price, string $taxNumber): int
    {
        $countryCode = $this->getCountryCode($taxNumber);
        $taxValue = $this->taxValueRepository->findOneBy(['country_code' => $countryCode]);

        if (!$taxValue) {
            throw new Exception('Country code not found.');
        }

        return $price + ($price * $taxValue->getAmount() / 100);
    }

    private function getCountryCode(string $taxNumber): string
    {
        return substr($taxNumber, 0, 2);
    }
}
