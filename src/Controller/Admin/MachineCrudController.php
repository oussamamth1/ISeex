<?php

namespace App\Controller\Admin;

use App\Entity\Machine;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MachineCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Machine::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
        return [
                  
            TextField::new('referonce'),
           
            AssociationField::new('article'),
            TextField::new('Marque'),
            TextField::new('Type'),
        ];
    }
 
}
