<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
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
                "constraints" => [
                    new NotBlank(["message" => "Un véhicule ne peux pas être gratuit !"])
                ]
            ])
            ->add("image", FileType::class,[
                "label" => "L'image",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Vous devez ajouter une image !"]),
                    new File([
                        'maxSize' => "5M",
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/gif',
                            'image/png',
                            'image/svg+xml',
                            'image/jpg',
                            'image/webp',
                            'image/avif'
                        ],
                        'mimeTypesMessage' => 'Veuillez proposer une image valide'
                    ])
                ]
            ])
            ->add("circulationDate", NumberType::class,[
                "label" => "La date de mise en circulation",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "La date de mise en circulation ne doit pas être vide !"])
                ]
            ])
            ->add("km", NumberType::class,[
                "label" => "Le kilométrage",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Le kilométrage ne doit pas être vide !"])
                ]
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