<?php

namespace App\Controller\Admin;

use App\Entity\Ouvier;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OuvierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ouvier::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('prenom'),
           
            TextField::new('matricule'),
            TextField::new('category'),
          
        ];
    }
  
}
