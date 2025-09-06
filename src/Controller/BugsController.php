<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BugRepository;
use App\Entity\Bug;
use App\Form\BugType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

final class BugsController extends AbstractController
{
    #[Route('/bugs', name: 'latest_bugs')]
    public function index(BugRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {

        $query = $repository->createQueryBuilder('bug')
            ->orderBy('bug.createdAt', 'DESC')
            ->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('bugs/index.html.twig', [
            'bugs' => $pagination,
        ]);

        /*return $this->render('bugs/index.html.twig', [
            'bugs' => $repository->findAll(),
        ]);*/
    }

    #[Route('/bug/{id}', name: 'show_bug')]
    public function show(Bug $bug): Response
    {
        return $this->render('bugs/show.html.twig', [
            'bug' => $bug
        ]);
    }

    #[Route('/bugs/new', name: 'new_bug')]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $bug = new Bug;

        $form = $this->createForm(BugType::class, $bug);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($bug);
            $manager->flush();

            $this->addFlash(
                'notice_bug',
                'Bug successfully created!'
            );

            return $this->redirectToRoute('show_bug', [
                'id' => $bug->getId()
            ]);
        }
        return $this->render('bugs/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/bug/{id<\d+>}/edit', name: 'edit_bug')]
    public function edit(Bug $bug, Request $request, EntityManagerInterface $manager): Response
    {

        $form = $this->createForm(BugType::class, $bug);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            $this->addFlash(
                'notice_bug',
                'Bug successfully updated!'
            );

            return $this->redirectToRoute('show_bug', [
                'id' => $bug->getId()
            ]);
        }
        return $this->render('bugs/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/bug/{id<\d+>}/delete', name: 'delete_bug')]
    public function delete(Bug $bug, Request $request, EntityManagerInterface $manager): Response
    {
        if ($request->isMethod('POST')) {
            $manager->remove($bug);
            $manager->flush();

            $this->addFlash(
                'notice_bug',
                'Bug successfully deleted!'
            );
            return $this->redirectToRoute('latest_bugs');
        }

        return $this->render('bugs/delete.html.twig', [
            'id' => $bug->getId(),
        ]);
    }
}
