<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker\Factory;
use App\Entity\Client;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ClientFixtures extends Fixture
{
    private $faker;
    public function __construct()
    {
        $this->faker = Factory::create("fr_FR");
    }
    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<30;$i++){
        $client = new Client();
        $client -> setNom($this -> faker->firstName());
        $client -> setPrenom($this -> faker->lastName());
        $client -> setAdresseRue($this -> faker->streetAddress());
        $client -> setCodePostale($this -> faker->postcode());
        $client -> setVille($this -> faker->city());
        $client -> setCourriel($this -> faker->email());
        $client -> setTelfixe($this -> faker->phoneNumber());
        $client -> setTelPortable($this -> faker->phoneNumber());

        $this->addReference('client'.$i,$client);
        $manager->persist($client);
        }
        $manager->flush();
    }
    
}
