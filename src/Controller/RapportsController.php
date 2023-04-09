<?php

namespace App\Controller;

use App\Entity\Rapports;
use App\Form\RapportsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/rapports')]
class RapportsController extends AbstractController
{
    #[Route('/', name: 'app_rapports_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $rapports = $entityManager
            ->getRepository(Rapports::class)
            ->findAll();

        return $this->render('rapports/index.html.twig', [
            'rapports' => $rapports,
        ]);
    }

    #[Route('/new', name: 'app_rapports_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rapport = new Rapports();
        $form = $this->createForm(RapportsType::class, $rapport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rapport);
            $entityManager->flush();

            return $this->redirectToRoute('app_rapports_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rapports/new.html.twig', [
            'rapport' => $rapport,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rapports_show', methods: ['GET'])]
    public function show(Rapports $rapport): Response
    {
        return $this->render('rapports/show.html.twig', [
            'rapport' => $rapport,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_rapports_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Rapports $rapport, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RapportsType::class, $rapport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_rapports_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rapports/edit.html.twig', [
            'rapport' => $rapport,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rapports_delete', methods: ['POST'])]
    public function delete(Request $request, Rapports $rapport, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rapport->getId(), $request->request->get('_token'))) {
            $entityManager->remove($rapport);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_rapports_index', [], Response::HTTP_SEE_OTHER);
    }
}
