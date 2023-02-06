<?php

namespace App\Controller;

use App\Converter\LessonToLessonDTO;
use App\Entity\Lesson;
use App\Entity\User;
use App\Repository\LessonRepository;
use App\Service\UserService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

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
     * @var LessonToLessonDTO
     */
    private $lessonToLessonDTO;

    /**
     * @param UserService $usrService
     */
    public function __construct(UserService $usrService, LessonToLessonDTO $lessonToLessonDTO)
    {
        $this->userService = $usrService;
        $this->lessonToLessonDTO = $lessonToLessonDTO;
    }


    /**
     * @Route("/lessons/tutor/{pageNo}/{numOfRecords}", name="all_lessons_for_tutor", methods="GET")
     */
    public function getAllLessonsByTutorPageable(
        ManagerRegistry $doctrine,
        SerializerInterface $serializer,
        int $pageNo,
        int $numOfRecords
    ): Response
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


        $json = $serializer->serialize(
            $lessons,
            'json', ['groups' => ['lesson']]
        );

        return new Response($json);
    }

    /**
     * @Route("/lessons/student/{pageNo}/{numOfRecords}", name="all_lessons_for_student", methods="GET")
     */
    public function getAllLessonsByStudentPageable(
        ManagerRegistry $doctrine,
        SerializerInterface $serializer,
        int $pageNo,
        int $numOfRecords
    ): Response
    {

        $entityManager = $doctrine->getManager();

        /**
         * @type LessonRepository $lessonRepository
         */
        $lessonRepository = $entityManager->getRepository(Lesson::class);

        // Get tutor from jwt
        /**
         * @var User $student
         */
        $student = $this->userService->getCurrentUser();

        // Calculate firstResult
        if ($pageNo == 0)
            $firstResult = 0;
        else {
            $firstResult = ($numOfRecords * $pageNo) + 1;
        }

        $lessons = $lessonRepository->getAllLessonsForEnrolledStudent(
            $student->getId(),
            $firstResult,
            $numOfRecords
        );


        $json = $serializer->serialize(
            $lessons,
            'json', ['groups' => ['student_lesson']]
        );

        return new Response($json);
    }

    /**
     * @Route("/lesson/name/{lessonName}", name="lesson_by_name", methods="GET")
     */
    public function getLessonByName(
        ManagerRegistry $doctrine,
        SerializerInterface $serializer,
        string $lessonName
    ) :Response
    {
        $lessonRepository = $doctrine->getRepository(Lesson::class);

        $lesson = $lessonRepository->findOneBy(['name' => $lessonName]);

        $json = $serializer->serialize(
            $lesson,
            'json', ['groups' => ['student_lesson']]
        );

        return new Response($json);
    }
}



