<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CarType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("title", TextType::class,[
                "label" => "Le titre de l'annonce",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Le titre ne doit pas être vide !"])
                ]
            ])
            ->add("price", NumberType::class,[
                "label" => "Le prix",
                "required" => true,
            ])
            ->add("image", TextType::class,[
                "label" => "L'image",
                "required" => true,
            ])
            ->add("circulationDate", NumberType::class,[
                "label" => "La date de mise en circulation",
                "required" => true,
            ])
            ->add("km", NumberType::class,[
                "label" => "Le kilométrage",
                "required" => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Car::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'car_item',
        ]);
    }
}