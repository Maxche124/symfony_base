<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\Enum\OrderStatus;
use App\Entity\User;
use App\Entity\Address;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use DateTimeImmutable;

class OrderFixtures extends Fixture implements DependentFixtureInterface
{
    public const ORDER_COUNT = 20;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < self::ORDER_COUNT; $i++) {
            $order = new Order();
            $order->setReference($faker->unique()->numerify('order_######'));
            $order->setStatus($faker->randomElement(OrderStatus::cases()));
            
            $user = $this->getReference('user_' . $faker->numberBetween(0, 9), User::class);
            $shippingAddress = $this->getReference('address_' . $faker->numberBetween(0, 19), Address::class);
            $billingAddress = $this->getReference('address_' . $faker->numberBetween(0, 19), Address::class);

            $order->setUser($user);
            $order->setShippingAddress($shippingAddress);
            $order->setBillingAddress($billingAddress);
            $order->setCreatedAt(DateTimeImmutable::createFromMutable($faker->dateTimeThisDecade()));

            $this->addReference('order_' . $i, $order);

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
