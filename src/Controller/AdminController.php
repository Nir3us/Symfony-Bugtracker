<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\AdminType;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/profile', name: 'admin_profile')]
    public function editProfile(Request $request, EntityManagerInterface $em): Response
    {
        /** @var Admin $admin */
        $admin = $this->getUser();

        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Profile updated!');
            return $this->redirectToRoute('admin_profile');
        }

        return $this->render('admin/profile.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/change-password', name: 'admin_change_password')]
    public function changePassword(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        /** @var Admin $admin */
        $admin = $this->getUser();

        $form = $this->createForm(ChangePasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('plainPassword')->getData();
            $hashedPassword = $passwordHasher->hashPassword($admin, $plainPassword);
            $admin->setPassword($hashedPassword);

            $em->flush();
            $this->addFlash('success', 'Password updated!');
            return $this->redirectToRoute('admin_profile');
        }

        return $this->render('admin/change_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
