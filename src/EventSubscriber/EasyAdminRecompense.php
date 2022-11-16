<?php

namespace App\EventSubscriber;

use App\Entity\Actualites;
use App\Entity\Recompenses;
use App\Entity\Tournois;
use DateTimeZone;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityPersistedEvent;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminRecompense implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [BeforeEntityPersistedEvent::class => ['setCreatedAt'],
            BeforeEntityUpdatedEvent::class => ['setUpdatedAt']
        ];
    }

    public function setCreatedAt(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if (!($entity instanceof Actualites)) {
            return;
        }
        $now = new \DateTime('now', new DateTimeZone('Europe/Paris'));
        $entity->setCreatedAt($now);
    }

    public function setUpdatedAt(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();
        $now = new \DateTime('now', new DateTimeZone('Europe/Paris'));
        $entity->setUpdatedAt($now);
    }


}