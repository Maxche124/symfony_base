<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\Enum\OrderStatus;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use DateTimeImmutable;

class OrderFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $order = new Order();
            $order->setReference($faker->unique()->numerify('order_######'));
            $order->setStatus($faker->randomElement(OrderStatus::cases()));
            $user = $this->getReference('user_' . $faker->numberBetween(0, 9));
            $order->setUser($user);
            $order->setShippingAddress($this->getReference('address_' . $faker->numberBetween(0, 19)));
            $order->setBillingAddress($this->getReference('address_' . $faker->numberBetween(0, 19)));
            $order->setCreatedAt(DateTimeImmutable::createFromMutable($faker->dateTimeThisDecade));

            $manager->persist($order);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            AddressFixtures::class,
        ];
    }
}
