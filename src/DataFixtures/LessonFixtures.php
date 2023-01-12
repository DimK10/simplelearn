<?php

namespace App\DataFixtures;

use App\Entity\Lesson;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Provider\Lorem;

class LessonFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $lessonTitles = [
        0 => 'Math',
        1 => 'Physics',
        2 => 'Geometry',
        3 => 'Programming'
    ];

        $faker = Factory::create();

        $userRepository = $manager->getRepository(User::class);

        $admin= $userRepository->findOneBy(["email" =>"admin@gmail.com"]);
        $enrolledStudent0= $userRepository->findOneBy(["email" =>"student0@gmail.com"]);
        $enrolledStudent1= $userRepository->findOneBy(["email" =>"student1@gmail.com"]);
        $enrolledStudent2= $userRepository->findOneBy(["email" =>"student2@gmail.com"]);

        /* Lesson 1 t student 0 */
        $lesson = new Lesson();
        $lesson->setId(1);
        $lesson->setName("Math");
        $lesson->setDescription($faker->text());
        $lesson->setTutor($admin);
        $lesson->addEnrolledStudent($enrolledStudent0);
        $manager->persist($lesson);

        /* Lesson 2 to student 1 */
        $lesson = new Lesson();
        $lesson->setId(2);
        $lesson->setName("Physics");
        $lesson->setDescription($faker->text());
        $lesson->setTutor($admin);
        $lesson->addEnrolledStudent($enrolledStudent1);
        $manager->persist($lesson);

        /* Lesson 3 to student 2 */
        $lesson = new Lesson();
        $lesson->setId(3);
        $lesson->setName("Geometry");
        $lesson->setDescription($faker->text());
        $lesson->setTutor($admin);
        $lesson->addEnrolledStudent($enrolledStudent2);
        $manager->persist($lesson);

        /* Lesson 4 to no student */
        $lesson = new Lesson();
        $lesson->setId(4);
        $lesson->setName("Programming");
        $lesson->setDescription($faker->text());
        $lesson->setTutor($admin);
        $manager->persist($lesson);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}
