<?php

/**
 * This file is part of the Symfony Bugtracker project.
 *
 * Symfony form type for changing User password im the database.
 *
 * (c)Norbert Białek <mlodszy.bialek@gmail.com>
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', PasswordType::class, [
                'label' => 'form.new_password',
                'mapped' => false, // nie jest powiązane bezpośrednio z encją
                'constraints' => [
                    new NotBlank([
                        'message' => 'form.not_blank',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
