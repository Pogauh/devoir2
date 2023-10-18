<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker\Factory;
use App\Entity\Location;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Client;

class LocationFixtures extends Fixture implements DependentFixtureInterface 
{
    private $faker;
    public function __construct()
    {
        $this->faker = Factory::create("fr_FR");
    }
    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<30;$i++){
        $location = new Location();
        $location -> setDateDebutLocation($this -> faker->datetime());
        $location -> setDateFinLocation($this -> faker->datetime());
        $this->addReference('location'.$i,$location);
        $location->setClient($this->getReference('client'.mt_rand(0,10)));
        $location->setBijou($this->getReference('bijou'.mt_rand(0,10)));

        $manager->persist($location);
        }
        $manager->flush();
    }
    public function getDependencies(){

        return [ClientFixtures::class,
                BijouFixtures::class];
    }
    
    
}


