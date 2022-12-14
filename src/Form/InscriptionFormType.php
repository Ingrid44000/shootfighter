<?php

namespace App\Form;

use App\Entity\Participants;
use App\Entity\Recompenses;
use App\Entity\Tournois;
use App\Entity\User;
use App\Repository\ParticipantsRepository;
use App\Repository\RecompensesRepository;
use App\Repository\TournoisRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\Entity;
use EasyCorp\Bundle\EasyAdminBundle\Form\Filter\Type\ChoiceFilterType;
use EasyCorp\Bundle\EasyAdminBundle\Form\Filter\Type\TextFilterType;
use phpDocumentor\Reflection\PseudoType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Vich\UploaderBundle\Form\Type\VichImageType;

class InscriptionFormType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('tournois', EntityType::class, ['class'=>Tournois::class, 'disabled'=>true])
            ->add ('recompenses', EntityType::class, ['class'=>Recompenses::class])
            ->add('pseudo')
            ->add('nom')
            ->add('prenom')
            ->add('email', EmailType::class)
            ->add('adresse_postale')
            ->add('code_postal')
            ->add('ville')
            ->add('pays');



    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
            'data_class' => Participants::class,


        ]);
    }
}
