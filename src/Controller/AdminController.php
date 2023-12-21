<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\TicketRepository;
use App\Repository\PromotionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\StatusRepository;

class AdminController extends AbstractController
{
    #[security("is_granted('ROLE_ADMIN')")]
    #[Route('/admin', name: 'app_admin')]
    public function index(TicketRepository $ticketRepository, UserRepository $userRepository, PromotionRepository $promotionRepository, StatusRepository $statusRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'tickets' => $ticketRepository->findBy([], ['dateCreate' => 'DESC']),
            'users' => $userRepository->findBy([], ['id' => 'DESC']),
            'status' => $statusRepository->findBy([], ['id' => 'ASC']),
            'promotions' => $promotionRepository->findBy([], ['id' => 'DESC']),
        ]);
    }
}
