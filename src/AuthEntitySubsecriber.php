<?php
namespace App;

use App\Entity\Post;
use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Common\EventSubscriber;
use ContainerVFraxv3\getResponseService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponesForControllerResultEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class AuthEntitySubsecriber implements EventSubscriberInterface{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;
    public function __construct(TokenStorageInterface $tokenStorage)
    {
$this->tokenStorage=$tokenStorage;  
        
    }
     public static function getSubscribedEvents()
     {
         return[KernelEvents::VIEW=>['getAuthenticatedUser',EventPriorities::PRE_WRITE]];
     }
public function getAuthenticatedUser(ViewEvent $event){

             $entity=$event->getControllerResult();
             $getauth=$event->getControllerResult();
             $methode=$event->getRequest()->getMethod();
            
             $email=$this->tokenStorage->getToken()->getUsername();
             $auth=$this->tokenStorage->getToken()->getUser();
            if($entity instanceof Post ){
                 $entity->setTitle($auth);
           }
           if($getauth instanceof Post ){
                $getauth->setUserpost($auth);
       }
  
      
}
}