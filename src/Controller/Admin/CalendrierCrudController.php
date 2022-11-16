<?php

namespace App\Controller\Admin;

use App\Entity\Actualites;
use App\Entity\Calendrier;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CalendrierCrudController
{
    public static function getEntityFqcn(): string
    {
        return Calendrier::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('texte'),
            DateTimeField::new('createdAt')->setLabel('Créé le')->hideOnForm()->setRequired(false),
            DateTimeField::new('updatedAt')->setLabel('Modifié le')->hideOnForm()->setRequired(false),
        ];

    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions // Ajoute un bouton
        ->add(Crud::PAGE_NEW, Action::INDEX)
            ->add(Crud::PAGE_EDIT, Action::INDEX);
    }
}