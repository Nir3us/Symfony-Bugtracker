<?php

/**
 * This file is part of the Symfony Bugtracker project.
 *
 * Controller handling requests for Registration management.
 *
 * (c)Norbert Białek <mlodszy.bialek@gmail.com>
 * Licensed under MIT License.
 */

namespace App\Controller;

use App\Entity\Admin;
use App\Form\RegistrationFormType;
use App\Service\RegistrationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, RegistrationService $registrationService): Response
    {
        $user = new Admin();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();

            // delegacja logiki do serwisu
            $registrationService->register($user, $plainPassword);

            $this->addFlash('success', 'flash.register_success');

            return $this->redirectToRoute('app_home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
