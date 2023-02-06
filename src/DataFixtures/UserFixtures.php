<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends BaseFixture
{
    /**
     * @var  UserPasswordHasherInterface
     */
    private $passwordEncoder;

    public const ADMIN_USER_REFERENCE = 'admin-user';

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function loadData(ObjectManager $manager)
    {
        $faker = Factory::create();

        // Create admin
        $user = new User();

        $user->setId(1);
        $user->setEmail('admin@gmail.com');
        $user->setUsername($faker->userName());

        $user->setRoles(["ROLE_ADMIN"]);
        $user->setPassword($this->passwordEncoder->hashPassword($user, '123456!Aa'));

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::ADMIN_USER_REFERENCE, $user);

        $this->createMany(3, 'users', function ($i) {

            $faker = Factory::create();

            $user = new User();

            $user->setId($i + 2);
            $user->setEmail(sprintf('student%d@gmail.com', $i));
            $user->setUsername($faker->userName());

            $user->setRoles(["ROLE_STUDENT"]);
            $user->setPassword($this->passwordEncoder->hashPassword($user, '123456!Aa'));

            return $user;
        });

        $manager->flush();
    }
}
