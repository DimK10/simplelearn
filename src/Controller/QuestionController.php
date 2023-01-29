<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Entity\Question;
use App\Repository\LessonRepository;
use App\Repository\QuestionRepository;
use App\Service\ClassService;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


/**
 * @Route("/api", name="api_")
 */class QuestionController extends AbstractController
{
    /**
     * Check if removable method - is it really needed?
     * @Route("/lesson/questions/save/{lessonId}", name="save_all_questions_for_lesson", methods="POST")
     */
    public function saveAllQuestions(ManagerRegistry $doctrine, Request $request, SerializerInterface $serializer, int $lessonId): Response
    {

        $entityManager = $doctrine->getManager();

        // Get request body parameters
        xdebug_break();
        $decoded = json_decode($request->getContent());

        $questions = $decoded->questions;

        // Get lesson from lesson id
        /**
         * @var LessonRepository $lessonRepository
         */
        $lessonRepository = $entityManager
            ->getRepository(Lesson::class);

        /**
         * @var QuestionRepository $questionRepository
         */
        $questionRepository = $entityManager
            ->getRepository(Question::class);

        $lesson = $lessonRepository->find($lessonId);

        /**
         * @var Question $question
         */
        foreach ($questions as $question) {
            $lesson->addQuestion($question);
            $question->setLesson($lesson);
            $entityManager->persist($question);
        }

        $entityManager->persist($lesson);
        $entityManager->flush();

        // Get the persisted lesson from db and return to user
        $lesson = $lessonRepository->find($lessonId);

        $json = $serializer->serialize(
            $lesson,
            'json', ['groups' => 'lesson']
        );


        return new Response($json);
    }

    /**
     * @Route("/lesson/question/save/{lessonId}", name="save_question_for_lesson", methods="POST")
     * @throws NonUniqueResultException
     */
    public function saveQuestion(ManagerRegistry $doctrine, Request $request, SerializerInterface $serializer, int $lessonId, ClassService $classService) :Response
    {
        $entityManager = $doctrine->getManager();

        // Get request body parameters
//        xdebug_break();

        $decoded = json_decode($request->getContent());

        /**
         * @var Question $question
         */
        $question = $classService->cast($decoded, Question::class);

//        $question = $serializer->deserialize($request->getContent(), Question::class, 'json');

        // Get lesson from lesson id
        /**
         * @var LessonRepository $lessonRepository
         */
        $lessonRepository = $entityManager
            ->getRepository(Lesson::class);

        /**
         * @var QuestionRepository $questionRepository
         */
        $questionRepository = $entityManager
            ->getRepository(Question::class);

        $lesson = $lessonRepository->find($lessonId);

        $lesson->addQuestion($question);
        $question->setLesson($lesson);

        $entityManager->persist($question);
        $entityManager->flush();

        // Get the persisted question from db and return to user
        $question = $questionRepository->findLastQuestionByLessonId($lessonId);

        $json = $serializer->serialize(
            $question,
            'json', ['groups' => ['lesson']]
        );


        return new Response($json);
    }

    /**
     * @Route("/lesson/question/edit/{lessonId}", name="edit_question_for_lesson", methods="POST")
     * @throws NonUniqueResultException
     */
    public function editQuestion(ManagerRegistry $doctrine, Request $request, SerializerInterface $serializer, int $lessonId, ClassService $classService) :Response
    {
        $entityManager = $doctrine->getManager();

        // Get request body parameters
//        xdebug_break();

        $decoded = json_decode($request->getContent());

        /**
         * @var Question $questionToEdit
         */
        $questionToEdit = $classService->cast($decoded, Question::class);

        // Get lesson from lesson id
        /**
         * @var LessonRepository $lessonRepository
         */
        $lessonRepository = $entityManager
            ->getRepository(Lesson::class);

        /**
         * @var QuestionRepository $questionRepository
         */
        $questionRepository = $entityManager
            ->getRepository(Question::class);

        $lesson = $lessonRepository->find($lessonId);

        /**
         * Question $questionFromLesson
         */
        $questionFromLesson = null;

        foreach ($lesson->getQuestions() as &$question) {
            if ($question->getId() === $questionToEdit->getId()) {
                $questionFromLesson = $question;
            }
        }

        if ($questionFromLesson !== null) {
            $questionFromLesson->setTitle($questionToEdit->getTitle());
            $questionFromLesson->setDifficulty($questionToEdit->getDifficulty());
            $questionFromLesson->setStatus(($questionToEdit->getStatus()));
            $questionFromLesson->setRowNum(($questionToEdit->getRowNum()));

            $entityManager->persist($questionFromLesson);
            $entityManager->flush();
        }

        // Get the persisted question from db and return to user
        $questionFromDb = $questionRepository->findLastQuestionByLessonId($lessonId);

        $json = $serializer->serialize(
            $questionFromDb,
            'json', ['groups' => ['lesson']]
        );


        return new Response($json);
    }
}
