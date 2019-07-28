<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    private $faker;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->faker = \Faker\Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $this->loadUsers($manager);
        $this->loadProducts($manager);
    }

    public function loadProducts(ObjectManager $manager)
    {
        $user = $this->getReference('user_admin');

        for($i=0; $i<100; $i++)
        {
            $product = new Product();
            $product->setName($this->faker->realText(30));
            $product->setPublished(($this->faker->dateTime));
            $product->setContent($this->faker->realText(50));
            $product->setAuthor($user);
            $product->setSlug($this->faker->slug);

            $this->setReference("product_$i", $product);

            $manager->persist($product);
        }

        $manager->flush();
    }

    public function loadUsers(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@product.com');
        $user->setName('Dawid Bury');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'secret123#'
        ));

        $this->addReference('user_admin', $user);

        $manager->persist($user);
        $manager->flush();
    }
}
