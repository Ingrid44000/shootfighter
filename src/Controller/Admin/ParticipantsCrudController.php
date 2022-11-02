<?php

namespace App\Controller\Admin;

use App\Entity\Participants;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ParticipantsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Participants::class;
    }
    public function configureFields(string $pageName): iterable

    {
        yield TextField::new('pseudo');
        yield TextField::new('nom');
        yield TextField::new('prenom');
        yield TextField::new('email');
        yield TextField::new('adressePostale');
        yield IntegerField::new('codePostal');
        yield TextField::new('ville');
        yield TextField::new('pays');

    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions // Ajoute un bouton
        ->add(Crud::PAGE_NEW, Action::INDEX)
            ->add(Crud::PAGE_EDIT, Action::INDEX);

    }
    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
