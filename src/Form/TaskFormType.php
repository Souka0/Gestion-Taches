<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TaskFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titre' , TextType::class, [
                'attr' => array(
                    'class' => 'classTitre',
                    "placeholder" => "Entrez le Titre de la tache",
                ),
                'label' => false,
                'required' => false
            ])
            ->add('Description', TextareaType::class, [
                'attr' => array(
                    'class' => 'classDescription',
                    "placeholder" => "Entrez le Description de la tache",
                ),
                'label' => false,
                'required' => false
            ])
            ->add('DateCreation', DateTimeType::class, [
                'widget' => 'single_text',
                'html5' => true,
                'attr' => ['class' => 'js-datepicker'],
                /* 'attr' => array(
                    'class' => 'classDateCreation',
                    "placeholder" => "Entrez le Description de la tache",
                ), */
                'label' => false,
                'required' => false
            ])
            ->add('etat', ChoiceType::class, [
                'choices' => [
                    'encours' => 'encours',
                    'terminee' => 'terminee',
                    'annulee' => 'annulee',
                ],
                'data' => 'encours', // Set the default value to 2 
                'label' => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
