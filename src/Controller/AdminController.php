<?php

namespace App\Controller;

use App\Repository\EventRepository;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(EventRepository $eventRepository, ReservationRepository $reservationRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'events' => $eventRepository->findAll(),
            'reservations' => $reservationRepository->findAll(),
        ]);
    }
}