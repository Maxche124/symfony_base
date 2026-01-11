<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\PokeBall;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class OrderItemFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 50; ++$i) {
            $orderItem = new OrderItem();
            $orderItem->setUserOrder($this->getReference('order_'.$faker->numberBetween(0, OrderFixtures::ORDER_COUNT - 1), Order::class));
            $orderItem->setPokeBall($this->getReference('pokeBall_'.$faker->numberBetween(0, count(PokeBallFixtures::POKEBALLS) - 1), PokeBall::class));
            $orderItem->setQuantity($faker->numberBetween(1, 10));
            $orderItem->setProductPrice($faker->randomFloat(2, 5, 200));
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
