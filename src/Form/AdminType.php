<?php

/**
 * This file is part of the Symfony Bugtracker project.
 *
 * Symfony form type for changing email of existing Admin.
 *
 * (c)Norbert Białek <mlodszy.bialek@gmail.com>
 */

namespace App\Form;

use App\Entity\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
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
