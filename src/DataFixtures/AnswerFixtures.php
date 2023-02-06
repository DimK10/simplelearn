<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AnswerFixtures extends BaseFixture implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager): void
    {

        // Math answers for question 1
        // region
        /**
         * @var Question $mathQuestion
         */
        $mathQuestion =$this->getReference("math_question_1");

        $answer = new Answer();
        $answer->setId(1);
        $answer->setRowNum(1);
        $answer->setStatus("show");
        $answer->setText("9");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_1", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(2);
        $answer->setRowNum(2);
        $answer->setStatus("show");
        $answer->setText("10");
        $answer->setCorrect(true);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_2", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(3);
        $answer->setRowNum(3);
        $answer->setStatus("show");
        $answer->setText("11");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_3", $answer);

        $manager->persist($answer);


        $answer = new Answer();
        $answer->setId(4);
        $answer->setRowNum(4);
        $answer->setStatus("show");
        $answer->setText("12");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_4", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(5);
        $answer->setRowNum(5);
        $answer->setStatus("show");
        $answer->setText("13");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_5", $answer);

        $manager->persist($answer);

        //endregion

        // Math answers for question 2
        // region
        /**
         * @var Question $mathQuestion
         */
        $mathQuestion =$this->getReference("math_question_2");

        $answer = new Answer();
        $answer->setId(6);
        $answer->setRowNum(6);
        $answer->setStatus("show");
        $answer->setText("44");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_6", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(7);
        $answer->setRowNum(7);
        $answer->setStatus("show");
        $answer->setText("48");
        $answer->setCorrect(true);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_7", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(8);
        $answer->setRowNum(8);
        $answer->setStatus("show");
        $answer->setText("50");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_8", $answer);

        $manager->persist($answer);


        $answer = new Answer();
        $answer->setId(9);
        $answer->setRowNum(9);
        $answer->setStatus("show");
        $answer->setText("52");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_9", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(10);
        $answer->setRowNum(10);
        $answer->setStatus("show");
        $answer->setText("56");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_10", $answer);

        $manager->persist($answer);
        // endregion

        // Math answers for question 3
        // region
        /**
         * @var Question $mathQuestion
         */
        $mathQuestion =$this->getReference("math_question_3");

        $answer = new Answer();
        $answer->setId(11);
        $answer->setRowNum(11);
        $answer->setStatus("show");
        $answer->setText("5");
        $answer->setCorrect(true);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_11", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(12);
        $answer->setRowNum(12);
        $answer->setStatus("show");
        $answer->setText("6");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_12", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(13);
        $answer->setRowNum(13);
        $answer->setStatus("show");
        $answer->setText("7");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_13", $answer);

        $manager->persist($answer);


        $answer = new Answer();
        $answer->setId(14);
        $answer->setRowNum(14);
        $answer->setStatus("show");
        $answer->setText("8");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_14", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(15);
        $answer->setRowNum(15);
        $answer->setStatus("show");
        $answer->setText("9");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_15", $answer);

        $manager->persist($answer);
        // endregion

        // Math answers for question 4
        // region
        /**
         * @var Question $mathQuestion
         */
        $mathQuestion =$this->getReference("math_question_4");

        $answer = new Answer();
        $answer->setId(16);
        $answer->setRowNum(16);
        $answer->setStatus("show");
        $answer->setText("12");
        $answer->setCorrect(true);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_16", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(17);
        $answer->setRowNum(17);
        $answer->setStatus("show");
        $answer->setText("13");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_17", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(18);
        $answer->setRowNum(18);
        $answer->setStatus("show");
        $answer->setText("14");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_18", $answer);

        $manager->persist($answer);


        $answer = new Answer();
        $answer->setId(19);
        $answer->setRowNum(19);
        $answer->setStatus("show");
        $answer->setText("15");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_19", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(20);
        $answer->setRowNum(20);
        $answer->setStatus("show");
        $answer->setText("16");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_20", $answer);

        $manager->persist($answer);
        // endregion

        $manager->flush();

    }

    public function getDependencies(): array
    {
        return [
            QuestionFixtures::class
        ];
    }
}