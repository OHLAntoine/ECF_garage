<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("subject", TextType::class, [
                "label" => "Sujet de la demande",
                "required" => false,
            ])
            ->add("firstname", TextType::class,[
                "label" => "Votre prénom",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Vous devez rentrer un prénom"]),
                    new Length(["min" => 2, "minMessage" => "Vous devez entrer prénom d'au moins 2 caractères", "max" => 255, "maxMessage" => "Le prénom doit faire 255 caractères maximum."])
                ]
            ])
            ->add("lastname", TextType::class,[
                "label" => "Votre nom",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Vous devez rentrer un nom"]),
                    new Length(["min" => 1, "minMessage" => "Vous devez entrer un nom d'au moins 1 caractères", "max" => 255, "maxMessage" => "Le nom doit faire 255 caractères maximum."])
                ]
            ])
            ->add("email", EmailType::class,[
                "label" => "Votre email",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Vous devez rentrer un email"]),
                    new Email(['message' => 'Veuillez renter un email valide.'])
                ]
            ])
            ->add("telNumber", NumberType::class,[
                "label" => "Votre numéro de téléphone :",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Vous devez rentrer un numéro de téléphone"]),
                    new Length(["min" => 9, "minMessage" => "Vous devez entrer un numéro Français (soit 9 chiffres sans le 0 au début)", "max" => 9, "maxMessage" => "Vous devez entrer un numéro Français (soit 9 chiffres) et sans espaces"])
                ]
            ])
            ->add("message", TextareaType::class,[
                "label" => "Votre message",
                'attr' => ['rows' => 5],
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Vous devez rentrer un numéro de téléphone"]),
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Contact::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'contact_item',
        ]);
    }
}