<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker\Factory;
use App\Entity\Bijou;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class BijouFixtures extends Fixture implements DependentFixtureInterface
{
    private $faker;
    public function __construct()
    {
        $this->faker = Factory::create("fr_FR");
    }
    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<30;$i++){
        $bijou = new bijou();
        $bijou -> setDescription($this -> faker->text());
        $bijou -> setPrixVente($this -> faker->numberBetween(1,500));
        $bijou -> setPrixLocation($this -> faker->numberbetween(30,600));
        $bijou->setCategorie($this->getReference('categorie'.mt_rand(0,10)));

        $this->addReference('bijou'.$i,$bijou);
        $manager->persist($bijou);
        }
        $manager->flush();
    }

    public function getDependencies(){
        return [CategorieFixtures::class];
    }
}
