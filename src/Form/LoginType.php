<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class LoginType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("username", TextType::class,[
                "label" => "Votre Email",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Votre email ne doit pas être vide !"]),
                    new Length([
                        "max" => 180,
                        "maxMessage" => "Votre email doit faire moins de 180 caractères"])
                ]
            ])
            ->add("password", PasswordType::class,[
                "label" => "Votre mot de passe",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Votre mot de passe ne doit pas être vide !"]),
                    new Length([
                    "min" => 10,
                    "minMessage" => "Votre mot de passe doit faire plus de 10 caractères"])
            ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => User::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'login_item',
        ]);
    }
}