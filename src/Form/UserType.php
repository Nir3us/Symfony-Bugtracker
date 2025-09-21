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
            ->add('email',null, [
                'label' => 'form.email',
            ])
            ->add('password',null, [
                'label' => 'form.password',
            ])
            ->add('roles',null, [
                'label' => 'form.roles',
            ])
            ->add('name_user',null, [
                'label' => 'form.name_user',
            ])
            ->add('form.createdAt',null, [
                'label' => 'form.createdAt',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
