<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, ['label' => 'Pseudo' , 'constraints' => [
        new Assert\NotBlank(),
        new Assert\Length(['min' => 2, 'max' => 180])],
                    ])

            ->add('plainPassword',
                RepeatedType::class, [
                    'type' => PasswordType::class,
                    'mapped'=>false,
                    'first_options' => ['label' => false,

                    ],
                    'second_options' => ['label' => false,
                        'constraints' => [
                            new Assert\NotBlank(),
                            new Assert\Length(['min' => 4, 'max' => 180]),
                    ],
                ]])

            ->add('email', EmailType::class, ['label' => 'Email' , 'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length(['min' => 6, 'max' => 180])],
            ])

        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
