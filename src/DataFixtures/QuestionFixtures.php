<?php

namespace App\DataFixtures;

use App\Entity\Lesson;
use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class QuestionFixtures extends BaseFixture implements DependentFixtureInterface
{

    protected function loadData(ObjectManager $manager) : void
    {
        // get math lesson
        /**
         * @var Lesson $mathLesson
         */
        $mathLesson = $this->getReference("math_lesson");

        $question = new Question();
        $question->setId(1);
        $question->setTitle("What is 7 + 3?");
        $question->setStatus("show");
        $question->setRowNum(1);
        $question->setDifficulty("easy");
        $question->setLesson($mathLesson);
        $manager->persist($question);

        $this->addReference("math_question_1", $question);


        $question = new Question();
        $question->setId(2);
        $question->setTitle("What is 12 x 4?");
        $question->setStatus("show");
        $question->setRowNum(2);
        $question->setDifficulty("easy");
        $question->setLesson($mathLesson);
        $manager->persist($question);

        $this->addReference("math_question_2", $question);


        $question = new Question();
        $question->setId(3);
        $question->setTitle("What is 20 divided by 4?");
        $question->setStatus("show");
        $question->setRowNum(3);
        $question->setDifficulty("easy");
        $question->setLesson($mathLesson);
        $manager->persist($question);

        $this->addReference("math_question_3", $question);

        $question = new Question();
        $question->setId(4);
        $question->setTitle("What is the square root of 144?");
        $question->setStatus("show");
        $question->setRowNum(4);
        $question->setDifficulty("easy");
        $question->setLesson($mathLesson);
        $manager->persist($question);

        $this->addReference("math_question_4", $question);

        $question = new Question();
        $question->setId(5);
        $question->setTitle("What is 2 to the power of 3?");
        $question->setStatus("show");
        $question->setRowNum(5);
        $question->setDifficulty("medium");
        $question->setLesson($mathLesson);
        $manager->persist($question);

        $this->addReference("math_question_5", $question);

        $question = new Question();
        $question->setId(6);
        $question->setTitle("What is 20 - 10?");
        $question->setStatus("show");
        $question->setRowNum(6);
        $question->setDifficulty("medium");
        $question->setLesson($mathLesson);
        $manager->persist($question);

        $this->addReference("math_question_6", $question);

        $question = new Question();
        $question->setId(7);
        $question->setTitle("What is the result of 15 / 3?");
        $question->setStatus("show");
        $question->setRowNum(7);
        $question->setDifficulty("medium");
        $question->setLesson($mathLesson);
        $manager->persist($question);

        $this->addReference("math_question_7", $question);

        $question = new Question();
        $question->setId(8);
        $question->setTitle("What is the result of 9 x 5?");
        $question->setStatus("show");
        $question->setRowNum(8);
        $question->setDifficulty("medium");
        $question->setLesson($mathLesson);
        $manager->persist($question);

        $this->addReference("math_question_8", $question);

        $question = new Question();
        $question->setId(9);
        $question->setTitle("What is the result of 25 - 15?");
        $question->setStatus("show");
        $question->setRowNum(9);
        $question->setDifficulty("hard");
        $question->setLesson($mathLesson);
        $manager->persist($question);

        $this->addReference("math_question_9", $question);

        $question = new Question();
        $question->setId(10);
        $question->setTitle("What is the result of 16 divided by 4?");
        $question->setStatus("show");
        $question->setRowNum(10);
        $question->setDifficulty("hard");
        $question->setLesson($mathLesson);
        $manager->persist($question);

        $this->addReference("math_question_10", $question);

        $question = new Question();
        $question->setId(11);
        $question->setTitle("What is the result of 8 x 6?");
        $question->setStatus("show");
        $question->setRowNum(11);
        $question->setDifficulty("hard");
        $question->setLesson($mathLesson);
        $manager->persist($question);

        $this->addReference("math_question_11", $question);

        $question = new Question();
        $question->setId(12);
        $question->setTitle("What is the result of 7 x 7?");
        $question->setStatus("show");
        $question->setRowNum(12);
        $question->setDifficulty("hard");
        $question->setLesson($mathLesson);
        $manager->persist($question);

        $this->addReference("math_question_12", $question);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            LessonFixtures::class
        ];
    }
}
