<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\UserRepository;

class MyAccountController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/myaccount', name: 'app_my_account', methods:['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        $userId = $user->getId();
        

        return $this->render('my_account/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
}
