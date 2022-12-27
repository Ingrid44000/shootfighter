<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Vich\UploaderBundle\Form\Type\VichImageType;

class MonProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username',TextType::class,[
                'required'=>false,
                // Ici on définit la taille du label
                'label_attr' => [
                    'class' => 'col-5'
                ],
                // En dessous on définit la taille du champ
                'attr' => [
                    'class' => 'col-7',
                ],

            ])

            ->add('password',RepeatedType::class,[
                'type' => PasswordType::class,
                'required'=>true,
                'mapped' => false,
                'label_attr' => [
                    'class' => 'd-none'
                ],
                'attr' => [
                    'class' => 'col-12'
                ],
                'first_options'  => ['label' => false,
                    // Ici on définit la taille du label
                    'label_attr' => [
                        'class'=> 'col-5 py-2'
                    ],

                ],
                'second_options' => ['label' => false,
                    // Ici on définit la taille du label
                    'label_attr' => [
                        'class' => 'col-5 py-2'
                    ],

                ],
            ])
            ->add('email',TextType::class,[
                'required'=>false,
                // Ici on définit la taille du label
                'label_attr' => [
                    'class' => 'col-5'
                ],
                // En dessous on définit la taille du champ
                'attr' => [
                    'class' => 'col-7'
                ],
            ])
            ->add('nom',TextType::class,[
                'required'=>false,
                // Ici on définit la taille du label
                'label_attr' => [
                    'class' => 'col-5'
                ],
                // En dessous on définit la taille du champ
                'attr' => [
                    'class'=>'col-7',
                ],
            ])
            ->add('prenom',TextType::class,[
                'required'=>false,
                // Ici on définit la taille du label
                'label_attr' => [
                    'class' => 'col-5'
                ],
                // En dessous on définit la taille du champ
                'attr' => [
                    'class'=>'col-7',
                ],
            ])
            ->add('imageFile', VichImageType::class, [
                'label' =>'Photo de profil',
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
