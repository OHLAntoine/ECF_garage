<?php

namespace App\Form;

use App\Entity\Planning;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanningType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("morningStart", TimeType::class,[
                "label" => "Horaires d'ouverture le matin",
                "required" => true,
            ])
            ->add("morningEnd", TimeType::class,[
                "label" => "Horaires de fermeture le matin",
                "required" => true,
            ])
            ->add("afternoonStart", TimeType::class,[
                "label" => "Horaires d'ouverture l'après midi",
                "required" => true,
            ])
            ->add("afternoonEnd", TimeType::class,[
                "label" => "Horaires de fermeture l'après midi",
                "required" => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Planning::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'planning_item',
        ]);
    }
}