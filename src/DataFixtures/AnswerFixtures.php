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

        // Math answers for question 5
        // region
        /**
         * @var Question $mathQuestion
         */
        $mathQuestion =$this->getReference("math_question_5");

        $answer = new Answer();
        $answer->setId(21);
        $answer->setRowNum(21);
        $answer->setStatus("show");
        $answer->setText("5");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_21", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(22);
        $answer->setRowNum(22);
        $answer->setStatus("show");
        $answer->setText("6");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_22", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(23);
        $answer->setRowNum(23);
        $answer->setStatus("show");
        $answer->setText("7");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_23", $answer);

        $manager->persist($answer);


        $answer = new Answer();
        $answer->setId(24);
        $answer->setRowNum(24);
        $answer->setStatus("show");
        $answer->setText("8");
        $answer->setCorrect(true);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_24", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(25);
        $answer->setRowNum(25);
        $answer->setStatus("show");
        $answer->setText("9");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_25", $answer);

        $manager->persist($answer);
        // endregion

        // Math answers for question 6
        // region
        /**
         * @var Question $mathQuestion
         */
        $mathQuestion =$this->getReference("math_question_6");

        $answer = new Answer();
        $answer->setId(26);
        $answer->setRowNum(26);
        $answer->setStatus("show");
        $answer->setText("0");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_26", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(27);
        $answer->setRowNum(27);
        $answer->setStatus("show");
        $answer->setText("5");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_27", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(28);
        $answer->setRowNum(28);
        $answer->setStatus("show");
        $answer->setText("10");
        $answer->setCorrect(true);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_28", $answer);

        $manager->persist($answer);


        $answer = new Answer();
        $answer->setId(29);
        $answer->setRowNum(29);
        $answer->setStatus("show");
        $answer->setText("15");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_29", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(30);
        $answer->setRowNum(30);
        $answer->setStatus("show");
        $answer->setText("20");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_30", $answer);

        $manager->persist($answer);
        // endregion

        // Math answers for question 7
        // region
        /**
         * @var Question $mathQuestion
         */
        $mathQuestion =$this->getReference("math_question_7");

        $answer = new Answer();
        $answer->setId(31);
        $answer->setRowNum(31);
        $answer->setStatus("show");
        $answer->setText("3");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_31", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(32);
        $answer->setRowNum(32);
        $answer->setStatus("show");
        $answer->setText("4");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_32", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(33);
        $answer->setRowNum(33);
        $answer->setStatus("show");
        $answer->setText("5");
        $answer->setCorrect(true);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_33", $answer);

        $manager->persist($answer);


        $answer = new Answer();
        $answer->setId(34);
        $answer->setRowNum(34);
        $answer->setStatus("show");
        $answer->setText("6");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_34", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(35);
        $answer->setRowNum(35);
        $answer->setStatus("show");
        $answer->setText("7");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_35", $answer);

        $manager->persist($answer);
        // endregion

        // Math answers for question 8
        // region
        /**
         * @var Question $mathQuestion
         */
        $mathQuestion =$this->getReference("math_question_8");

        $answer = new Answer();
        $answer->setId(36);
        $answer->setRowNum(36);
        $answer->setStatus("show");
        $answer->setText("45");
        $answer->setCorrect(true);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_36", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(37);
        $answer->setRowNum(37);
        $answer->setStatus("show");
        $answer->setText("46");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_37", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(38);
        $answer->setRowNum(38);
        $answer->setStatus("show");
        $answer->setText("47");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_38", $answer);

        $manager->persist($answer);


        $answer = new Answer();
        $answer->setId(39);
        $answer->setRowNum(39);
        $answer->setStatus("show");
        $answer->setText("48");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_39", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(40);
        $answer->setRowNum(40);
        $answer->setStatus("show");
        $answer->setText("49");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_40", $answer);

        $manager->persist($answer);
        // endregion

        // Math answers for question 9
        // region
        /**
         * @var Question $mathQuestion
         */
        $mathQuestion =$this->getReference("math_question_9");

        $answer = new Answer();
        $answer->setId(41);
        $answer->setRowNum(41);
        $answer->setStatus("show");
        $answer->setText("5");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_41", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(42);
        $answer->setRowNum(42);
        $answer->setStatus("show");
        $answer->setText("10");
        $answer->setCorrect(true);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_42", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(43);
        $answer->setRowNum(43);
        $answer->setStatus("show");
        $answer->setText("15");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_43", $answer);

        $manager->persist($answer);


        $answer = new Answer();
        $answer->setId(44);
        $answer->setRowNum(44);
        $answer->setStatus("show");
        $answer->setText("20");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_44", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(45);
        $answer->setRowNum(45);
        $answer->setStatus("show");
        $answer->setText("25");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_45", $answer);

        $manager->persist($answer);
        // endregion

        // Math answers for question 10
        // region
        /**
         * @var Question $mathQuestion
         */
        $mathQuestion =$this->getReference("math_question_10");

        $answer = new Answer();
        $answer->setId(46);
        $answer->setRowNum(46);
        $answer->setStatus("show");
        $answer->setText("3");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_46", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(47);
        $answer->setRowNum(47);
        $answer->setStatus("show");
        $answer->setText("4");
        $answer->setCorrect(true);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_47", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(48);
        $answer->setRowNum(48);
        $answer->setStatus("show");
        $answer->setText("5");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_48", $answer);

        $manager->persist($answer);


        $answer = new Answer();
        $answer->setId(49);
        $answer->setRowNum(49);
        $answer->setStatus("show");
        $answer->setText("6");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_49", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(50);
        $answer->setRowNum(50);
        $answer->setStatus("show");
        $answer->setText("7");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_50", $answer);

        $manager->persist($answer);
        // endregion

        // Math answers for question 11
        // region
        /**
         * @var Question $mathQuestion
         */
        $mathQuestion =$this->getReference("math_question_11");

        $answer = new Answer();
        $answer->setId(51);
        $answer->setRowNum(51);
        $answer->setStatus("show");
        $answer->setText("42");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_51", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(52);
        $answer->setRowNum(52);
        $answer->setStatus("show");
        $answer->setText("44");
        $answer->setCorrect(true);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_52", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(53);
        $answer->setRowNum(53);
        $answer->setStatus("show");
        $answer->setText("46");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_53", $answer);

        $manager->persist($answer);


        $answer = new Answer();
        $answer->setId(54);
        $answer->setRowNum(54);
        $answer->setStatus("show");
        $answer->setText("48");
        $answer->setCorrect(true);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_54", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(55);
        $answer->setRowNum(55);
        $answer->setStatus("show");
        $answer->setText("50");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_55", $answer);

        $manager->persist($answer);
        // endregion

        // Math answers for question 12
        // region
        /**
         * @var Question $mathQuestion
         */
        $mathQuestion =$this->getReference("math_question_11");

        $answer = new Answer();
        $answer->setId(56);
        $answer->setRowNum(56);
        $answer->setStatus("show");
        $answer->setText("44");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_56", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(57);
        $answer->setRowNum(57);
        $answer->setStatus("show");
        $answer->setText("46");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_57", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(58);
        $answer->setRowNum(58);
        $answer->setStatus("show");
        $answer->setText("48");
        $answer->setCorrect(false);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_58", $answer);

        $manager->persist($answer);


        $answer = new Answer();
        $answer->setId(59);
        $answer->setRowNum(59);
        $answer->setStatus("show");
        $answer->setText("50");
        $answer->setCorrect(true);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_59", $answer);

        $manager->persist($answer);

        $answer = new Answer();
        $answer->setId(60);
        $answer->setRowNum(60);
        $answer->setStatus("show");
        $answer->setText("49");
        $answer->setCorrect(true);
        $answer->setQuestion($mathQuestion);

        $this->addReference("math_answer_60", $answer);

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
