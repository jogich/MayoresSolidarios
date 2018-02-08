<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityManager;

/**
 * NotificationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NotificationRepository extends \Doctrine\ORM\EntityRepository
{
    public function countNotifications()
    {
       $query = $this->getEntityManager()->getRepository('AppBundle:Notification')->findAll();

       $allNotifications = count($query);

       return $allNotifications;

    }
}
