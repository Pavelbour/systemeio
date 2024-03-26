<?php

namespace App\DataFixtures;

use App\Entity\TaxValue;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TaxValueFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tax = new TaxValue();
        $tax->setCountryCode('DE');
        $tax->setAmount(19);
        $manager->persist($tax);

        $tax = new TaxValue();
        $tax->setCountryCode('IT');
        $tax->setAmount(22);
        $manager->persist($tax);

        $tax = new TaxValue();
        $tax->setCountryCode('FR');
        $tax->setAmount(20);
        $manager->persist($tax);

        $tax = new TaxValue();
        $tax->setCountryCode('GR');
        $tax->setAmount(24);
        $manager->persist($tax);

        $manager->flush();
    }
}
