<?php

namespace App\DataFixtures;

use App\Entity\PokeBall;
use App\Entity\Enum\PokeBallStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PokeBallFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $pokeBallNames = ['Poke Ball', 'Great Ball', 'Ultra Ball', 'Master Ball', 'Safari Ball', 'Fast Ball', 'Level Ball', 'Lure Ball', 'Heavy Ball', 'Love Ball', 'Friend Ball', 'Moon Ball', 'Sport Ball', 'Park Ball', 'Dream Ball', 'Beast Ball'];

        foreach ($pokeBallNames as $name) {
            $pokeBall = new PokeBall();
            $pokeBall->setName($name);
            $pokeBall->setPrice($faker->randomFloat(2, 5, 200));
            $pokeBall->setDescription($faker->sentence);
            $pokeBall->setStock($faker->numberBetween(0, 100));
            $pokeBall->setStatus(PokeBallStatus::cases()[$faker->numberBetween(0, count(PokeBallStatus::cases()) - 1)]);
            $pokeBall->setTauxCapture($faker->randomFloat(2, 1, 10));

            // Get a random category
            $category = $this->getReference('category_' . $faker->numberBetween(0, 4));
            $pokeBall->setCategory($category);

            $manager->persist($pokeBall);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
