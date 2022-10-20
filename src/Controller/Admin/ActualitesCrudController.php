<?php

namespace App\Controller\Admin;

use App\Entity\Actualites;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ActualitesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Actualites::class;
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
