<?php

/**
 * This file is part of the Symfony Bugtracker project.
 *
 * Symfony form type for adding new Bug to the database.
 *
 * (c)Norbert Białek <mlodszy.bialek@gmail.com>
 */

namespace App\Form;

use App\Entity\Bug;
use App\Entity\Project;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class BugType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'form.title',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'form.not_blank',
                    ]),
                ],
            ])
            ->add('description', null, [
                'label' => 'form.description',
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'form.status',
                'choices' => [
                    'Open' => 'Open',
                    'Closed' => 'Closed',
                ],
                'placeholder' => 'form.placeholder',
                'required' => true,
            ])
            ->add('project', EntityType::class, [
                'class' => Project::class,
                'choice_label' => 'name',
                'label' => 'form.name_project',
            ])
            ->add('reporter', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'name',
                'label' => 'form.name_user',
            ])
            ->add('save', SubmitType::class, ['label' => 'form.update_data'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bug::class,
        ]);
    }
}
