<?php

namespace App\DataFixtures;

use App\Entity\Address;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AddressFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $address = new Address();
            $address->setStreet($faker->streetAddress);
            $address->setCity($faker->city);
            $address->setPostalCode($faker->postcode);
            $address->setCountry($faker->country);
            $address->setUser($this->getReference('user_' . $faker->numberBetween(0, 9)));
            $manager->persist($address);
            $this->addReference('address_' . $i, $address);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
