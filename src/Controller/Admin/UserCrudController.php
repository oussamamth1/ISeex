<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Dto\BatchActionDto;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }
public function configureCrud(Crud $crud): Crud
{
    return $crud->setEntityPermission('ROLE_ADMIN');
}
  
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('email'),
            TextField::new('password')->setPermission('ROLE_SUPER_ADMIN')->hideWhenUpdating(),
            ArrayField::new('roles'),
        ];
    }
 public function configureActions(Actions $actions): Actions
 
 {
    
$ou= Action::new('viewInvoice','test1','fa fa-calendar')->linkToRoute('app_register');
$ou2= Action::new('viewInvoi','test2','fa fa-calendar')->linkToRoute('app_register2');
    // return $actions->setPermission(Action::DELETE,'ROLE_SUPER_ADMIN');
    //return $actions->remove(ACTION::INDEX,Action::DELETE);
   
    
    return $actions->add(Crud::PAGE_NEW,$ou2)
    ->add(Crud::PAGE_INDEX,$ou);
    return $actions->disable(Action::DELETE)->setPermission(Action::EDIT,'ROLE_SUPER_ADMIN');
   }    
 public function renderInvoice(AdminContext $context)
 {
     
$order = log("test");
     // add your logic here...
 }  
 public function renderInvoice1(AdminContext $context)
 {
     
$order = log("test");
     // add your logic here...
 } 
 
    # code...
}
    

