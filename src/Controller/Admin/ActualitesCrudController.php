<?php

namespace App\Controller\Admin;

use App\Entity\Actualites;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class ActualitesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Actualites::class;
    }

    public function configureFields(string $pageName): iterable
    {

            yield TextField::new('nom');
            yield TextField::new('texte');
            yield DateTimeField::new('createdAt')->setLabel('Créé le')->hideOnForm()->setRequired(false);
            yield DateTimeField::new('updatedAt')->setLabel('Modifié le')->hideOnForm()->setRequired(false);
            yield ImageField::new('imageName')
                ->setLabel('Image')
                ->setBasePath('images/actualites')
                ->setUploadDir('public/images/actualites')
                ->setRequired(false);

    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions // Ajoute un bouton
        ->add(Crud::PAGE_NEW, Action::INDEX)
                ->add(Crud::PAGE_EDIT, Action::INDEX);
            }
}