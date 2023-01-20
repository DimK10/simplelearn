<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Entity\Question;
use App\Repository\LessonRepository;
use App\Repository\QuestionRepository;
use Doctrine\Persistence\ManagerRegistry;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/api", name="api_")
 */class QuestionController extends AbstractController
{
    /**
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
}
