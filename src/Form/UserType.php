<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Context\ExecutionContext;

class UserType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("email", TextType::class,[
                "label" => "Entrer l'email de l'employé",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Votre email ne doit pas être vide !"]),
                    new Length([
                        "max" => 180,
                        "maxMessage" => "Votre email doit faire moins de 180 caractères"])
                ]
            ])
            ->add("password", PasswordType::class,[
                "label" => "Son mot de passe",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Votre mot de passe ne doit pas être vide !"]),
                    new Length([
                    "min" => 10,
                    "minMessage" => "Votre mot de passe doit faire plus de 10 caractères"])
            ]
        ])
            ->add("confirm", PasswordType::class,[
                "label" => "Confirmer le mot de passe",
                "required" => true,
                "constraints" => [
                    new NotBlank(["message" => "Votre mot de passe ne doit pas être vide !"]),
                    new Callback(['callback' => function ($value, ExecutionContext $ec) {
                        if ($ec->getRoot()['password']->getViewData() !== $value) {
                            $ec->addViolation("Le mot de passe doit être identique");
                        }
                    }])
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => User::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'user_item',
        ]);
    }
}