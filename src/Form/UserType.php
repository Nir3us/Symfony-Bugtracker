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
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('form.email')
            ->add('form.password')
            ->add('form.roles')
            ->add('form.name_user')
            ->add('form.createdAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
