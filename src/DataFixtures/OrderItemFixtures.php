<?php

namespace App\DataFixtures;

use App\Entity\OrderItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class OrderItemFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $orderItem = new OrderItem();
            $orderItem->setAssociatedOrder($this->getReference('order_' . $faker->numberBetween(0, 19)));
            $orderItem->setPokeBall($this->getReference('pokeball_' . $faker->numberBetween(0, 15)));
            $orderItem->setQuantity($faker->numberBetween(1, 10));
            $orderItem->setPrice($faker->randomFloat(2, 5, 200));
            $manager->persist($orderItem);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            OrderFixtures::class,
            PokeBallFixtures::class,
        ];
    }
}
