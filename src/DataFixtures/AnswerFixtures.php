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
        /**
         * @var Question $mathQuestion1
         */
        $mathQuestion1 =$this->getReference("math_question_1");

        $answer = new Answer();
        $answer->setId(1);
        $answer->setRowNum(1);
        $answer->setStatus("show");
        $answer->setText("9");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion1);

        $this->addReference("math_answer_1", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(2);
        $answer->setRowNum(2);
        $answer->setStatus("show");
        $answer->setText("10");
        $answer->setCorrect(true);
        $answer->setQuestion($mathQuestion1);

        $this->addReference("math_answer_2", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(3);
        $answer->setRowNum(3);
        $answer->setStatus("show");
        $answer->setText("11");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion1);

        $this->addReference("math_answer_3", $answer);

        $manager->persist($answer);


        $answer = new Answer();
        $answer->setId(4);
        $answer->setRowNum(4);
        $answer->setStatus("show");
        $answer->setText("12");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion1);

        $this->addReference("math_answer_4", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(5);
        $answer->setRowNum(5);
        $answer->setStatus("show");
        $answer->setText("13");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion1);

        $this->addReference("math_answer_5", $answer);

        $manager->persist($answer);


        $manager->flush();

    }

    public function getDependencies(): array
    {
        return [
            QuestionFixtures::class
        ];
    }
}
