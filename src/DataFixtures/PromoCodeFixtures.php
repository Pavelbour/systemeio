<?php

namespace App\DataFixtures;

use App\Entity\PromoCode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PromoCodeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $promoCode = new PromoCode();
        $promoCode->setCode('P10');
        $manager->persist($promoCode);

        $promoCode = new PromoCode();
        $promoCode->setCode('P5');
        $manager->persist($promoCode);

        $promoCode = new PromoCode();
        $promoCode->setCode('A5');
        $manager->persist($promoCode);

        $manager->flush();
    }
}
