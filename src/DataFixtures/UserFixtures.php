<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends BaseFixture
{
    /**
     * @var  UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public const ADMIN_USER_REFERENCE = 'admin-user';

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function loadData(ObjectManager $manager)
    {
        // Create admin
        $user = new User();

        $user->setEmail('admin@gmail.com');
        $user->setUsername($this->faker->userName);

        $user->setRoles(["ROLE_ADMIN"]);
        $user->setPassword($this->passwordEncoder->hashPassword($user, '123456!Aa'));

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::ADMIN_USER_REFERENCE, $user);

        $this->createMany(3, 'users', function ($i) {
            $user = new User();

            $user->setEmail(sprintf('student%d@gmail.com', $i));
            $user->setUsername($this->faker->userName);

            $user->setRoles(["ROLE_STUDENT"]);
            $user->setPassword($this->passwordEncoder->hashPassword($user, '123456!Aa'));

            return $user;
        });

        $manager->flush();
    }
}
