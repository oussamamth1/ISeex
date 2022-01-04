<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CurrencyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductCrudController extends AbstractCrudController
{
    
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }
   
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityPermission('ROLE_ADMIN','ROLE_USER','ROLE_SUPER_ADMIN');
        
    }
    
       
   
    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('name'),
            //TextareaField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex(),
            AssociationField::new('category'),
            AssociationField::new('publish')->hideOnForm(),
            AssociationField::new('client'),
            BooleanField::new('status'),
            BooleanField::new('StatusF'),
            NumberField::new('price'),
            //ImageField::new('imageFile')->setBasePath($this->getParameter("app.path.product_images"))->onlyOnIndex(),
            //TextareaField::new('imageFile','update you image')->setFormType(VichImageType::class)->onlyWhenUpdating(),

            ImageField::new('image',"product image")->setBasePath('/uploads/images/products/')->setUploadDir('/public/uploads/images/products/')->setUploadedFileNamePattern('[randomhash].[extension]')->setRequired(false),
         TextField::new('description'),
        ];}
        public function configureActions(Actions $actions): Actions
    {
        // this action executes the 'renderInvoice()' method of the current CRUD controller
        $viewInvoice = Action::new('viewInvoice', 'Invoice', 'fa fa-file-invoice')
            ->linkToCrudAction('renderInvoice');

        // if the method is not defined in a CRUD controller, link to its route
        $sendInvoice = Action::new('sendInvoice', 'Send invoice', 'fa fa-envelope')
            // if the route needs parameters, you can define them:
            // 1) using an array
            ->linkToRoute('invoice_send', [
                'send_at' => (new \DateTime('+ 0 minutes'))->format('YmdHis'),
            ])

            // 2) using a callable (useful if parameters depend on the entity instance)
            // (the type-hint of the function argument is optional but useful)
            ->linkToRoute('invoice_send', function (User $order): array {
                return [
                    'uuid' => $order->getId(),
                
                ];
            }
        );

      

        return $actions
            // ...
            ->add(Crud::PAGE_DETAIL, $viewInvoice)
            ->add(Crud::PAGE_DETAIL, $sendInvoice)
            
       
            ;
    }

    public function renderInvoice(AdminContext $context)
    {
        $order = $context->getEntity()->getInstance();

        // add your logic here...
    }
       
    }
  
       

