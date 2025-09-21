<?php

/**
 * This file is part of the Symfony Bugtracker project.
 *
 * Controller handling requests for Bug management.
 *
 * (c)Norbert Białek <mlodszy.bialek@gmail.com>
 * Licensed under MIT License.
 */

namespace App\Controller;

use App\Entity\Bug;
use App\Form\BugType;
use App\Service\BugService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BugsController extends AbstractController
{
    #[Route('/bugs', name: 'latest_bugs')]
    public function index(Request $request, BugService $bugService): Response
    {
        $page = $request->query->getInt('page', 1);
        $pagination = $bugService->getPaginatedBugs($page);

        return $this->render('bugs/index.html.twig', [
            'bugs' => $pagination,
        ]);
    }

    #[Route('/bug/{id}', name: 'show_bug')]
    public function show(Bug $bug): Response
    {
        return $this->render('bugs/show.html.twig', [
            'bug' => $bug,
        ]);
    }

    #[Route('/bugs/new', name: 'new_bug')]
    public function new(Request $request, BugService $bugService): Response
    {
        $bug = new Bug();
        $form = $this->createForm(BugType::class, $bug);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bugService->create($bug);

            $this->addFlash('notice_bug', 'flash.new_bug_created');

            return $this->redirectToRoute('show_bug', ['id' => $bug->getId()]);
        }

        return $this->render('bugs/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/bug/{id<\d+>}/edit', name: 'edit_bug')]
    public function edit(Bug $bug, Request $request, BugService $bugService): Response
    {
        $form = $this->createForm(BugType::class, $bug);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bugService->update();

            $this->addFlash('notice_bug', 'flash.update_bug');

            return $this->redirectToRoute('show_bug', ['id' => $bug->getId()]);
        }

        return $this->render('bugs/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/bug/{id<\d+>}/delete', name: 'delete_bug')]
    public function delete(Bug $bug, Request $request, BugService $bugService): Response
    {
        if ($request->isMethod('POST')) {
            $bugService->delete($bug);

            $this->addFlash('notice_bug', 'flash.delete_bug');

            return $this->redirectToRoute('latest_bugs');
        }

        return $this->render('bugs/delete.html.twig', [
            'id' => $bug->getId(),
        ]);
    }
}
