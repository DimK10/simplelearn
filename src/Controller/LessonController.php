<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Entity\User;
use App\Repository\LessonRepository;
use App\Service\UserService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api_")
 */
class LessonController extends AbstractController
{

    /**
     * @var  UserService
     */
    private $userService;

    /**
     * @param UserService $usrService
     */
    public function __construct(UserService $usrService)
    {
        $this->userService = $usrService;
    }


    /**
     * @Route("/lessons/tutor/{pageNo}/{numOfRecords}", name="all_lessons_for_tutor", methods="GET")
     */
    public function index(ManagerRegistry $doctrine, int $pageNo, int $numOfRecords): Response
    {

        $entityManager = $doctrine->getManager();

        /**
         * @type LessonRepository $lessonRepository
         */
        $lessonRepository = $entityManager->getRepository(Lesson::class);

        // Get tutor from jwt
        /**
         * @var User $tutor
         */
        $tutor = $this->userService->getCurrentUser();

        // Calculate firstResult
        if ($pageNo == 0)
            $firstResult = 0;
        else {
            $firstResult = ($numOfRecords * $pageNo) + 1;
        }

        $lessons = $lessonRepository->getAllLessonsForTutor($tutor, $firstResult, $numOfRecords);

        return $this->json($lessons);
    }
}
