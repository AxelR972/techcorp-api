<?php

namespace App\DataFixtures;

use App\Entity\Tool;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ToolFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Création des catégories directement
        $categoryNames = ['Development', 'Communication', 'Productivity', 'Design'];
        $categories = [];
        foreach ($categoryNames as $name) {
            $cat = new Category();
            $categories[] = $cat;
            $cat->setName($name);
            $cat->setCreatedAt(new \DateTimeImmutable('-' . $faker->numberBetween(30, 365) . ' days'));
            $cat->setColorHex($faker->hexColor); // génère un code couleur aléatoire
            $manager->persist($cat);
        }

        // Création des outils
        $departments = ['Engineering', 'Sales', 'Marketing', 'HR'];
        $statuses = ['active', 'inactive', 'pending'];

        for ($i = 0; $i < 50; $i++) {
            $tool = new Tool();
            $tool->setName($faker->company);
            $tool->setText($faker->paragraph);
            $tool->setVendor($faker->company);
            $tool->setCategory($faker->randomElement($categories)); // objet Category
            $tool->setMonthlyCost($faker->randomFloat(2, 5, 100));
            $tool->setOwnerDepartment($faker->randomElement($departments));
            $tool->setStatus($faker->randomElement($statuses));
            $tool->setWebsiteUrl($faker->url);
            $tool->setActiveUsersCount($faker->numberBetween(1, 100));
            $tool->setCreatedAt(new \DateTimeImmutable('-' . $faker->numberBetween(1, 365) . ' days'));
            $tool->setUpdatedAt(new \DateTimeImmutable('-' . $faker->numberBetween(0, 30) . ' days'));
            $manager->persist($tool);
        }

        $manager->flush();
    }
}
