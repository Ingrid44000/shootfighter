<?php

namespace App\Controller\Admin;

use App\Entity\Tournois;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class TournoisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tournois::class;
    }
    public function configureFields(string $pageName): iterable

    {
        yield TextField::new('nom');
        yield DateTimeField::new('date');
        yield IntegerField::new('nbPlacesMax');
        yield DateTimeField::new('dateLimiteInscription');
        yield ImageField::new('imageName')
            ->setLabel('Image')
            ->setBasePath('images/tournois')
            ->setUploadDir('public/images/tournois')
        ->setRequired(false);

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
