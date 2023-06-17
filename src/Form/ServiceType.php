<?php

namespace App\Form;

use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ServiceType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("title", TextType::class,[
                "label" => "Le titre du service",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Le titre ne doit pas être vide !"])
                ]
            ])
            ->add("description", TextareaType::class,[
                "label" => "La description du service",
                'attr' => ["rows" => "4", "cols" => "50"],
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "La description ne doit pas être vide !"])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Service::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'service_item',
        ]);
    }
}