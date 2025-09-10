<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\AdminType;
use App\Form\ChangePasswordType;
use App\Service\AdminService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/profile', name: 'admin_profile')]
    public function editProfile(Request $request, AdminService $adminService): Response
    {
        /** @var Admin $admin */
        $admin = $this->getUser();

        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adminService->updateProfile($admin);

            $this->addFlash('success', 'Profile updated!');

            return $this->redirectToRoute('admin_profile');
        }

        return $this->render('admin/profile.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/change-password', name: 'admin_change_password')]
    public function changePassword(Request $request, AdminService $adminService): Response
    {
        /** @var Admin $admin */
        $admin = $this->getUser();

        $form = $this->createForm(ChangePasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('plainPassword')->getData();
            $adminService->changePassword($admin, $plainPassword);

            $this->addFlash('success', 'Password updated!');

            return $this->redirectToRoute('admin_profile');
        }

        return $this->render('admin/change_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
