<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use App\Repository\QuestionRepository;
use App\Service\ClassService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api", name="api_")
 */
class AnswerController extends AbstractController
{
    /**
     * @Route("/answer/save/{questionId}", name="save_answer_of_question", methods="POST")
     */
    public function saveAnswer(ManagerRegistry $doctrine,Request $request, SerializerInterface $serializer, ClassService $classService, int $questionId): Response
    {

        $decoded = json_decode($request->getContent());

        $entityManager = $doctrine->getManager();

        /**
         * @var Answer $answer
         */
        $answer = $classService->cast($decoded, Answer::class);


        $questionRepository = $entityManager->getRepository(Question::class);

        $answerRepository = $entityManager->getRepository(Answer::class);

        $question = $questionRepository->find($questionId);

        if ($question === null) {
            return new Response('Question not found', Response::HTTP_NOT_FOUND);
        }

        $answer->setQuestion($question);
        $entityManager->persist($answer);
        $entityManager->flush();

        $answerFromDb = $answerRepository->findLastAnswerByQuestionId($questionId);

        $json = $serializer->serialize(
            $answerFromDb,
            'json', ['groups' => ['answer']]
        );

        return new Response($json);
    }

    /**
     * @Route("/answer/edit/{questionId}", name="edit_answer_of_question", methods="PUT")
     */
    public function editAnswer(ManagerRegistry $doctrine,Request $request, SerializerInterface $serializer, ClassService $classService, int $questionId): Response
    {
        $entityManager = $doctrine->getManager();

        $decoded = json_decode($request->getContent());

        /**
         * @var Answer $answerToEdit
         */
        $answerToEdit = $classService->cast($decoded, Answer::class);

        $questionRepository =
            $entityManager->getRepository(Question::class);

        $answerRepository = $entityManager->getRepository(Answer::class);

        $question = $questionRepository->find($questionId);

        /**
         * @var Answer $answerFromQuestion
         */
        $answerFromQuestion = null;

        /**
         * @var Answer $answer
         */
        foreach ($question->getAnswers() as $answer) {
            if ($answer->getId() === $answerToEdit->getId()) {
                $answerFromQuestion = $answer;
            }
        }

        if ($answerFromQuestion === null) {
            return new Response('Answer not found', Response::HTTP_NOT_FOUND);
        }

        $answerFromQuestion->setText($answerToEdit->getText());
        $answerFromQuestion->setCorrect($answerToEdit->getCorrect());
        $answerFromQuestion->setRowNum($answerToEdit->getRowNum());
        $answerFromQuestion->setStatus($answerToEdit->getStatus());

        $entityManager->persist($answerFromQuestion);
        $entityManager->flush();

        $answerFromDb = $answerRepository->find($answerToEdit->getId());

        $json = $serializer->serialize(
            $answerFromDb,
            'json', ['groups' => ['answer']]
        );

        return new Response($json);
    }

    /**
     * @Route("/answer/delete/{answerId}", name="delete_answer_of_question", methods="DELETE")
     */
    public function deleteAnswer(ManagerRegistry $doctrine,Request $request, SerializerInterface $serializer, ClassService $classService, int $answerId): Response
    {

        $answerRepository = $doctrine->getRepository(Answer::class);

        $answerToDelete = $answerRepository->find($answerId);

        if ($answerToDelete === null)
            return new Response('Answer not found', Response::HTTP_NOT_FOUND);

        $answerRepository->remove($answerToDelete, true);

        return new JsonResponse("The answer was deleted successfully!");
    }
}
