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
        $lesson1 = new Lesson();
        $lesson1->setId(1);
        $lesson1->setName("Math");
        $lesson1->setDescription($faker->text());
        $lesson1->setTutor($admin);
        $lesson1->addEnrolledStudent($enrolledStudent0);
        $manager->persist($lesson1);

        $this->addReference("math_lesson", $lesson1);

        /* Lesson 2 to student 1 */
        $lesson2 = new Lesson();
        $lesson2->setId(2);
        $lesson2->setName("Physics");
        $lesson2->setDescription($faker->text());
        $lesson2->setTutor($admin);
        $lesson2->addEnrolledStudent($enrolledStudent1);
        $manager->persist($lesson2);

        $this->addReference("physics_lesson", $lesson2);


        /* Lesson 3 to student 2 */
        $lesson3 = new Lesson();
        $lesson3->setId(3);
        $lesson3->setName("Geometry");
        $lesson3->setDescription($faker->text());
        $lesson3->setTutor($admin);
        $lesson3->addEnrolledStudent($enrolledStudent2);
        $manager->persist($lesson3);

        $this->addReference("geometry_lesson", $lesson3);


        /* Lesson 4 to no student */
        $lesson4 = new Lesson();
        $lesson4->setId(4);
        $lesson4->setName("Programming");
        $lesson4->setDescription($faker->text());
        $lesson4->setTutor($admin);
        $manager->persist($lesson4);

        $this->addReference("programming_lesson", $lesson4);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}
