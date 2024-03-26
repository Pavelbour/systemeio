<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $product = new Product();
        $product->setName('Iphone');
        $product->setPrice(10000);
        $manager->persist($product);

        $product = new Product();
        $product->setName('headphone');
        $product->setPrice(2000);
        $manager->persist($product);

        $product = new Product();
        $product->setName('case');
        $product->setPrice(1000);
        $manager->persist($product);

        $manager->flush();
    }
}
