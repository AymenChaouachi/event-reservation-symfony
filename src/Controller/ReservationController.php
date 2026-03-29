<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reserve/{id}', name: 'app_reserve', methods: ['POST'])]
    public function reserve(int $id, Request $request, EventRepository $eventRepository, EntityManagerInterface $em): Response
    {
        $event = $eventRepository->find($id);

        if (!$event) {
            throw $this->createNotFoundException();
        }

        $reservation = new Reservation();
        $reservation->setEvent($event);
        $reservation->setName($request->request->get('name'));
        $reservation->setEmail($request->request->get('email'));
        $reservation->setPhone($request->request->get('phone'));
        $reservation->setCreatedAt(new \DateTime());

        $em->persist($reservation);
        $em->flush();

        return $this->redirectToRoute('app_event_index');
    }
}