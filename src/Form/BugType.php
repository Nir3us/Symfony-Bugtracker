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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BugType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('form.title')
            ->add('form.description')
            ->add('form.status')
            ->add('form.createdAt')
            ->add('form.updatedAt')
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
            ->add('form.save', SubmitType::class, ['label' => 'form.update_data'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bug::class,
        ]);
    }
}
