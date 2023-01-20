<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Repository\LessonRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/lesson/questions/save/{lessonId}/", name="save_all_questions_for_lesson", methods="POST")
     */
    public function saveAllQuestions(ManagerRegistry $doctrine, int $lessonId): Response
    {

        $entityManager = $doctrine->getManager();

        // Get lesson from lesson id
        /**
         * @var LessonRepository $lessonRepository
         */
        $lessonRepository = $entityManager
            ->getRepository(Lesson::class);

        $lesson = $lessonRepository->find($lessonId);

//        $lesson-

        return new JsonResponse();
    }
}
