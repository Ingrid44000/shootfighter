<?php

namespace App\Controller\Admin;

use App\Entity\Recompenses;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RecompensesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recompenses::class;
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
