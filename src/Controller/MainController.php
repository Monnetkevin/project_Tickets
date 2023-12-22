<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Form\TicketType;
use App\Repository\UserRepository;
use App\Repository\StatusRepository;
use App\Repository\TicketRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class MainController extends AbstractController
{
    #[security("is_granted('ROLE_USER')")]
    #[Route('/', name: 'app_main')]
    public function index(TicketRepository $ticketRepository, UserRepository $userRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'tickets' => $ticketRepository->findBy([], ['dateCreate' => 'DESC']),
            'ticketsResolve' => $ticketRepository->findBy([], ['dateCreate' => 'DESC']),
            'users' => $userRepository->findAll(),
        ]);
    }


    #[security("is_granted('ROLE_USER')")]
    #[Route('/interdit', name: 'app_interdit')]
    public function interdit(): Response
    {
        return $this->render('main/interdit.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[security("is_granted('ROLE_USER')")]
    #[Route('/edit/{id}', name: 'app_main_edit', methods: ['GET', 'POST'])]
    public function edit(Ticket $ticket, EntityManagerInterface $entityManager, StatusRepository $statusRepository): Response
    {
        $now = new \DateTime();
        $ticket->setLastUpdate($now);
        $helper = $this->getUser();
        $ticket->setHelper($helper);

        if ($ticket->getStatus() != "Resolved" or "inProgress") {
            $status = $statusRepository->find(2);
            $ticket->setStatus($status);
        }

        $entityManager->persist($ticket);
        $entityManager->flush();

        return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
    }

    #[security("is_granted('ROLE_USER')")]
    #[Route('/resolved/{id}', name: 'app_main_resolved', methods: ['GET', 'POST'])]
    public function resolved(Ticket $ticket, EntityManagerInterface $entityManager, StatusRepository $statusRepository): Response
    {
        if ($ticket->getStatus() != "Resolved") {
            $now = new \DateTime();
            $ticket->setLastUpdate($now);
            $status = $statusRepository->find(3);
            $ticket->setStatus($status);
        }

        $entityManager->persist($ticket);
        $entityManager->flush();

        return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
    }
}
