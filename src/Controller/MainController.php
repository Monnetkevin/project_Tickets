<?php

namespace App\Controller;

use App\Repository\TicketRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class MainController extends AbstractController
{
    #[security("is_granted('ROLE_USER')")]
    #[Route('/', name: 'app_main')]
    public function index(TicketRepository $ticketRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'tickets' => $ticketRepository->findAll(),
        ]);
    }
}
