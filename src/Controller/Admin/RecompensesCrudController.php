<?php

namespace App\Controller\Admin;


use App\Entity\Recompenses;
use App\Entity\Tournois;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RecompensesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recompenses::class;
    }
    public function configureFields(string $pageName): iterable

    {
        yield TextField::new('nom');
        yield TextField::new('description');
        yield ImageField::new('imageName')
            ->setLabel('Image')
            ->setBasePath('images/recompense')
            ->setUploadDir('public/images/recompense')
            ->setRequired(false);
        yield AssociationField::new('tournois');

    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions // Ajoute un bouton
           ->add(Crud::PAGE_NEW, Action::INDEX)
        ->add(Crud::PAGE_EDIT, Action::INDEX);

    }
}
