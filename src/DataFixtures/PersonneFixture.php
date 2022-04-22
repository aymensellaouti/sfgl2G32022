<?php

namespace App\DataFixtures;

use App\Entity\Personne;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PersonneFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr');
        for ($i=0 ; $i < 20 ; $i++) {
            $personne = new Personne();
            $personne->setName($faker->firstName.' '. $faker->lastName);
            $personne->setAge($faker->numberBetween(18,65));
            $manager->persist($personne);
        }
        $manager->flush();
    }
}
