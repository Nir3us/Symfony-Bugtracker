<?php

/**
 * This file is part of the Symfony Bugtracker project.
 *
 * Symfony form type for registering new User to the database.
 *
 * (c)Norbert Białek <mlodszy.bialek@gmail.com>
 */

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', null, [
                'label' => 'form.email',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'form.not_blank',
                    ]),
                ],
            ])
            ->add('roles', null, [
                'label' => 'form.roles',
            ])
            ->add('name', null, [
                'label' => 'form.name_user',
            ])
            ->add('createdAt', null, [
                'label' => 'form.createdAt',
            ])
        ;
        if (!$options['is_edit']) {
            $builder->add('password', PasswordType::class, [
                'label' => 'form.password',
                'mapped' => false,
                'required' => true,
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'is_edit' => false,
        ]);
    }
}
