<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function __construct(UserService $usrService)
    {
        $this->userService = $usrService;
    }


    /**
     * @Route("/auth", name="app_auth", methods={"GET"})
     */
    public function index(): Response
    {
       $user = $this->userService->getCurrentUser();

       // Remove password
        $user->setPassword("");

       return $this->json($user);
    }
}
