<?php

namespace App\Controller;

use App\Entity\Maintenances;
use App\Form\MaintenancesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/maintenances')]
class MaintenancesController extends AbstractController
{
    #[Route('/', name: 'app_maintenances_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $maintenances = $entityManager
            ->getRepository(Maintenances::class)
            ->findAll();

        return $this->render('maintenances/index.html.twig', [
            'maintenances' => $maintenances,
        ]);
    }

    #[Route('/new', name: 'app_maintenances_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $maintenance = new Maintenances();
        $form = $this->createForm(MaintenancesType::class, $maintenance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($maintenance);
            $entityManager->flush();

            return $this->redirectToRoute('app_maintenances_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('maintenances/new.html.twig', [
            'maintenance' => $maintenance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_maintenances_show', methods: ['GET'])]
    public function show(Maintenances $maintenance): Response
    {
        return $this->render('maintenances/show.html.twig', [
            'maintenance' => $maintenance,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_maintenances_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Maintenances $maintenance, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MaintenancesType::class, $maintenance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_maintenances_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('maintenances/edit.html.twig', [
            'maintenance' => $maintenance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_maintenances_delete', methods: ['POST'])]
    public function delete(Request $request, Maintenances $maintenance, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$maintenance->getId(), $request->request->get('_token'))) {
            $entityManager->remove($maintenance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_maintenances_index', [], Response::HTTP_SEE_OTHER);
    }
}
