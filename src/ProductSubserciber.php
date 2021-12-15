<?php
namespace App;

use App\Entity\Post;
use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class ProductSubserciber implements EventSubscriberInterface{

private Security $security;
    public function __construct( Security $security)
    {
        $this->security=$security;
    }
public static function getSubscribedEvents(){
 return[BeforeEntityPersistedEvent::class=>['setPublish']];
}
public function setPublish(BeforeEntityPersistedEvent $even){
$entity=$even->getEntityInstance();
if($entity instanceof Product){
   $entity->setPublish($this->security->getUser());
}
if($entity instanceof Post){
    $entity->setUserpost($this->security->getUser());
 }
}
}