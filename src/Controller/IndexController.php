<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class IndexController extends AbstractController
{

    public function __construct(
        private UserRepository $user
    )
    {
        
    }
    #[Route('/index', name: 'app_index')]
    public function index(): Response
    {
        $users = $this->user->findAll();

        return $this->render('index/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/index/user/{id}', name: 'app_index_user')]
    public function employe(User $user): Response
    {
        return $this->render('index/index.html.twig', [
            'user' => $user,
        ]);
    }

}
