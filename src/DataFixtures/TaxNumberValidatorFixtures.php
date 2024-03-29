<?php

namespace App\DataFixtures;

use App\Entity\TaxNumberValidator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TaxNumberValidatorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $validator = new TaxNumberValidator();
        $validator->setCode('DE');
        $validator->setRegex('/^DE[0-9]{9}$/');
        $manager->persist($validator);

        $validator = new TaxNumberValidator();
        $validator->setCode('IT');
        $validator->setRegex('/^IT[0-9]{11}$/');
        $manager->persist($validator);

        $validator = new TaxNumberValidator();
        $validator->setCode('GR');
        $validator->setRegex('/^GR[0-9]{9}$/');
        $manager->persist($validator);

        $validator = new TaxNumberValidator();
        $validator->setCode('FR');
        $validator->setRegex('/^FR[A-Z]{2}[0-9]{9}$/');
        $manager->persist($validator);

        $manager->flush();
    }
}
