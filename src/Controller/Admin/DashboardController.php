<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Entity\User;
use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Client;
use App\Entity\Machine;
use App\Entity\Ouvier;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use PhpParser\Node\Expr\Yield_;
use Symfony\Component\Intl\DateFormatter\DateFormat\YearTransformer;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }
  
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ApiProject')
                // the name visible to end users
                
                // you can include HTML contents too (e.g. to link to an image)
                ->setTitle('<img src="..."> ACME <span class="text-small">Corp.</span>')
    
                // the path defined in this method is passed to the Twig asset() function
                ->setFaviconPath('favicon.svg')
    
                // the domain used by default is 'messages'
                ->setTranslationDomain('my-custom-domain')
    
                // there's no need to define the "text direction" explicitly because
                // its default value is inferred dynamically from the user locale
                ->setTextDirection('ltr')
    
                // set this option if you prefer the page content to span the entire
                // browser width, instead of the default design which sets a max width
                ->renderContentMaximized()
    
                // set this option if you prefer the sidebar (which contains the main menu)
                // to be displayed as a narrow column instead of the default expanded design
                ->renderSidebarMinimized()
    
                // by default, all backend URLs include a signature hash. If a user changes any
                // query parameter (to "hack" the backend) the signature won't match and EasyAdmin
                // triggers an error. If this causes any issue in your backend, call this method
                // to disable this feature and remove all URL signature checks
                ->disableUrlSignatures()
    
                // by default, all backend URLs are generated as absolute URLs. If you
                // need to generate relative URLs instead, call this method
                ->generateRelativeUrls()
            ;
        
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-calendar');
        yield  MenuItem::linkToExitImpersonation('Stop impersonation', 'fa fa-exit');
      
        yield MenuItem::linkToCrud('Artical', 'fa fa-archive', Category::class);
        yield MenuItem::linkToCrud('Ordre De Fabrication', 'fa fa-newspaper-o', Product::class);
        yield MenuItem::linkToCrud('User Posts', 'fa fa-commenting-o', Post::class);
        yield MenuItem::linkToCrud('Machine', '	fa fa-cogs', Machine::class);
        yield MenuItem::linkToCrud('Client type', '	fa fa-cogs', Client::class);
        yield MenuItem::linkToCrud('Ouvier', '	fa fa-drivers-license', Ouvier::class);
        if($this->IsGranted('ROLE_ADMIN')){    yield MenuItem::linkToCrud('user', 'fa fa-group', User::class);
         }
         yield MenuItem::linkToRoute('The Label', 'fa fa-archive', 'app_register');
         yield MenuItem::linkToUrl('Search in Google', 'fab fa-google', 'https://google.com');
      
    }
    public function configureUserMenu(UserInterface $user): UserMenu
    {
        // Usually it's better to call the parent method because that gives you a
        // user menu with some menu items already created ("sign out", "exit impersonation", etc.)
        // if you prefer to create the user menu from scratch, use: return UserMenu::new()->...
        return parent::configureUserMenu($user)
            // use the given $user object to get the user name
            ->setName($user->getUsername())
            // use this method if you don't want to display the name of the user
            ->displayUserName(false)

            
            ->setGravatarEmail($user->getUsername())

            // you can use any type of menu item, except submenus
            ->addMenuItems([
                MenuItem::linkToRoute('My Profile', 'fa fa-id-card', 'show', ['...' => '...']),
                MenuItem::linkToRoute('Settings', 'fa fa-user-cog', '...', ['...' => '...']),
                MenuItem::section(),
                MenuItem::linkToLogout('Logout', 'fa fa-sign-out'),
            ]);
    }
    
}
