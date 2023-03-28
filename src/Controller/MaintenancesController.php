<?php

namespace App\Controller;

use App\Entity\Maintenances;
use App\Form\MaintenancesType;
use App\Repository\MaintenancesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

#[Route('/maintenances')]
class MaintenancesController extends AbstractController
{
    #[Route('/afficher', name: 'app_maintenances_index', methods: ['GET'])]
    public function index(MaintenancesRepository $maintenancesRepository): Response
    {
        return $this->render('maintenances/index.html.twig', [
            'maintenances' => $maintenancesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_maintenances_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MaintenancesRepository $maintenancesRepository): Response
    {
        $maintenance = new Maintenances();
        $form = $this->createForm(MaintenancesType::class, $maintenance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $maintenancesRepository->save($maintenance, true);

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
    public function edit(Request $request, Maintenances $maintenance, MaintenancesRepository $maintenancesRepository): Response
    {
        $form = $this->createForm(MaintenancesType::class, $maintenance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $maintenancesRepository->save($maintenance, true);

            return $this->redirectToRoute('app_maintenances_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('maintenances/edit.html.twig', [
            'maintenance' => $maintenance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_maintenances_delete', methods: ['POST'])]
    public function delete(Request $request, Maintenances $maintenance, MaintenancesRepository $maintenancesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $maintenance->getId(), $request->request->get('_token'))) {
            $maintenancesRepository->remove($maintenance, true);
        }

        return $this->redirectToRoute('app_maintenances_index', [], Response::HTTP_SEE_OTHER);
    }
}
