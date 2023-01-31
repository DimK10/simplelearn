<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Question;
use App\Repository\QuestionRepository;
use App\Service\ClassService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
