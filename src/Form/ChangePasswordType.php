<?php

/**
 * This file is part of the Symfony Bugtracker project.
 *
 * Symfony form type for changing password for Admin.
 *
 * (c)Norbert Białek <mlodszy.bialek@gmail.com>
 */

namespace App\Form;

use App\Entity\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', PasswordType::class, [
                'label' => 'form.new_password',
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'form.not_blank',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'form.password_too_short',
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'form.update_data',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
        ]);
    }
}
