<?php

namespace App\Form;

use App\Entity\Avis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class AvisType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name", TextType::class,[
                "label" => "Votre nom et prénom",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Vous devez rentrer un nom de client"]),
                    new Length(["min" => 6, "minMessage" => "Vous devez entrer un nom et prénom d'au moins 6 caractères", "max" => 255, "maxMessage" => "Le nom et prénom doit faire 255 caractères maximum."])
                ]
            ])
            ->add("commentary", TextareaType::class, [
                "label" => "Ecrivez nous votre commentaire",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Vous devez rentrer un commentaire !"]),
                    new Length(["min" => 6, "minMessage" => "Vous devez entrer un commentaire d'au moins 6 caractères"])
                ]
            ])
            ->add("note", ChoiceType::class, [
                "label" => "Donnez nous une note !",
                "required" => true,
                "placeholder" => "Choisissez une note",
                'choices'  => [
                    '0 : Service déplorable' => 0,
                    '1 : Très insatisfait(e)' => 1,
                    '2 : Plutôt insatisfait(e)' => 2,
                    '3 : Ni satisfait(e) ni insatisfait(e)' => 3,
                    '4 : Plutôt satisfait(e)' => 4,
                    '5 : Très satisfait(e)' => 5,
                ],
            ])
            ->add("isModerate", CheckboxType::class, [
                "label" => "Afficher cet avis ?",
                "required" => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Avis::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'avis_item',
        ]);
    }
}