<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create(('fr_FR'));

        for ($i = 0; $i < 50; $i++) {
            $client = new Client();
            $client->setNom($faker->lastName);
            $client->setPrenom($faker->firstName);
            $client->setEmail($faker->email);
            $client->setTel($faker->phoneNumber);
            $manager->persist($client);
        }

        $manager->flush();
    }
}
