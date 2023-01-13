<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api", name="api_")
 */

class AuthController extends AbstractController
{

    /**
     * @var  UserService
     */
    private $userService;

    /**
     * @param UserService $usrService
     */
    public function __construct(UserService $usrService, )
    {
        $this->userService = $usrService;
    }


    /**
     * @Route("/auth", name="app_auth", methods={"GET"})
     */
    public function index(SerializerInterface $serializer): Response
    {
       $user = $this->userService->getCurrentUser();

       // Remove password
        // todo convert to dto
        $user->setPassword("");

        $json = $serializer->serialize(
            $user,
            'json', ['groups' => ['user', 'admin']]
        );

       return new Response($json);
    }
}
