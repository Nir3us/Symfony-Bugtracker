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
use Symfony\Component\Validator\Constraints\NotBlank;

class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', null, [
                'label' => 'form.title',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'form.not_blank',
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
