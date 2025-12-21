<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (['Common', 'Uncommon', 'Rare', 'Epic', 'Legendary'] as $i => $name) {
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
            $this->addReference('category_' . $i, $category);
        }

        $manager->flush();
    }
}
