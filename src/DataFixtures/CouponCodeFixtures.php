<?php

namespace App\DataFixtures;

use App\Entity\CouponCode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CouponCodeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $couponCode = new CouponCode();
        $couponCode->setCode('P10');
        $manager->persist($couponCode);

        $couponCode = new CouponCode();
        $couponCode->setCode('P5');
        $manager->persist($couponCode);

        $couponCode = new CouponCode();
        $couponCode->setCode('A5');
        $manager->persist($couponCode);

        $manager->flush();
    }
}
