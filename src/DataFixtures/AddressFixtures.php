<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\User;
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
            $address->setStreet($faker->streetAddress());
            $address->setCity($faker->city());
            $address->setPostalCode($faker->postcode());
            $address->setCountry($faker->country());

            /** @var User $user */
            $user = $this->getReference('user_' . $faker->numberBetween(0, 9), User::class);
            $address->setUser($user);

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
