<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Entity\User;
use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Machine;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

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
            ->setTitle('ApiProject');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-calendar');
        yield MenuItem::linkToCrud('Artical', 'fa fa-archive', Category::class);
        yield MenuItem::linkToCrud('Ordre De Fabrication', 'fa fa-newspaper-o', Product::class);
        yield MenuItem::linkToCrud('User Posts', 'fa fa-commenting-o', Post::class);
        yield MenuItem::linkToCrud('Machine', '	fa fa-cogs', Machine::class);
        if($this->IsGranted('ROLE_ADMIN')){    yield MenuItem::linkToCrud('user', 'fa fa-group', User::class);}
    
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
