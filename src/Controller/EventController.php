<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Event;

class EventController extends AbstractController
{
    #[Route('/', name: 'app_event_index')]
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('event/index.html.twig', [
            'events' => $eventRepository->findAll(),
        ]);
    }

    #[Route('/event/{id}', name: 'app_event_show')]
    public function show(int $id, EventRepository $eventRepository): Response
    {
        $event = $eventRepository->find($id);

        if (!$event) {
            throw $this->createNotFoundException();
        }

        return $this->render('event/show.html.twig', [
            'event' => $event,
        ]);
    }


    #[Route('/admin/event/new', name: 'app_event_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $event = new Event();

        if ($request->isMethod('POST')) {
            $event->setTitle($request->request->get('title'));
            $event->setDescription($request->request->get('description'));
            $event->setDate(new \DateTime($request->request->get('date')));
            $event->setLocation($request->request->get('location'));
            $event->setSeats((int)$request->request->get('seats'));

            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('app_admin');
        }

        return $this->render('event/new.html.twig');
    }

    #[Route('/admin/event/edit/{id}', name: 'app_event_edit')]
    public function edit(int $id, Request $request, EventRepository $repo, EntityManagerInterface $em): Response
    {
        $event = $repo->find($id);

        if (!$event) {
            throw $this->createNotFoundException();
        }

        if ($request->isMethod('POST')) {
            $event->setTitle($request->request->get('title'));
            $event->setDescription($request->request->get('description'));
            $event->setDate(new \DateTime($request->request->get('date')));
            $event->setLocation($request->request->get('location'));
            $event->setSeats((int)$request->request->get('seats'));

            $em->flush();

            return $this->redirectToRoute('app_admin');
        }

        return $this->render('event/edit.html.twig', [
            'event' => $event
        ]);
    }

    #[Route('/admin/event/delete/{id}', name: 'app_event_delete')]
    public function delete(int $id, EventRepository $repo, EntityManagerInterface $em): Response
    {
        $event = $repo->find($id);

        if ($event) {
            $em->remove($event);
            $em->flush();
        }

        return $this->redirectToRoute('app_admin');
    }

}