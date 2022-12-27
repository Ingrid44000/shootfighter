<?php

namespace App\Form;

use App\Entity\Participants;
use App\Entity\Recompenses;
use App\Entity\Tournois;
use App\Entity\User;

use SebastianBergmann\CodeCoverage\Report\Text;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionFormType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('tournois', EntityType::class, ['class'=>Tournois::class, 'disabled'=>true])
            ->add ('recompenses', EntityType::class, ['class'=>Recompenses::class,  'constraints'=> new Assert\NotBlank(),])
            ->add('pseudo', TextType::class, ['constraints'=>new Assert\NotBlank])
            ->add('nom', TextType::class, ['constraints'=>new Assert\NotBlank])
            ->add('prenom', TextType::class, ['constraints'=>new Assert\NotBlank])
            ->add('email', EmailType::class, ['constraints'=>new Assert\NotBlank])
            ->add('adresse_postale', TextType::class, ['constraints'=>new Assert\NotBlank])
            ->add('code_postal', TextType::class, ['constraints'=>new Assert\NotBlank])
            ->add('ville', TextType::class, ['constraints'=>new Assert\NotBlank])
            ->add('pays', TextType::class, ['constraints'=>new Assert\NotBlank]);



    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
            'data_class' => Participants::class,


        ]);
    }
}
