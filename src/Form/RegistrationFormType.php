<?php

namespace App\Form;

use App\Entity\User;
use phpDocumentor\Reflection\PseudoType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, ['label' => 'Pseudo'])
            ->add('plainPassword',
                RepeatedType::class, [
                    'type' => PasswordType::class,
                    'mapped'=>false,
                    'label_attr' => [
                        'class' => 'd-none'
                    ],
                    'attr' => [
                        'class' => 'col-12'
                    ],
                    'first_options' => ['label' => 'Mot de Passe :',
                        // Ici on définit la taille du label
                        'label_attr' => [
                            'class' => 'col-5 py-2'
                        ],
                        // En dessous on définit la taille du champ
                        'attr' => [
                            'class' => 'col-7',
                            'type' => 'password'
                        ]
                    ],
                    'second_options' => ['label' => 'Confirmation :',
                        // Ici on définit la taille du label
                        'label_attr' => [
                            'class' => 'col-5 py-2'
                        ],
                        // En dessous on définit la taille du champ
                        'attr' => [
                            'class' => 'col-7',
                            'type' => 'password'
                        ]
                    ],
                ])
            ->add('email', EmailType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
