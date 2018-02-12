<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Notification;
use AppBundle\Form\NotificationType;
use Doctrine\ORM\EntityManager;

class NotificationController extends Controller
{

    /**
     * @Route("/notification/", name="notification")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Notification');

        $notification = $repository->findAll();

        return $this->render('notification/index.html.twig', array('notification' => $notification));
    }



    /**
     * @Route("/notification/new/", name="notification-new")
     */
    public function newAction(Request $request)
    {
        $notification = new Notification();

        $form = $this->createForm(NotificationType::class, $notification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $notification = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($notification);
            $em->flush();

            return $this->redirectToRoute('notification');
        }

        // return $this->render('notification/new.html.twig', array('notification_new' => $form->createView()));
    }

    /**
     * @Route("/notification/{id}/edit/", name="notification-edit")
     */
    public function editAction(Request $request,$id)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Notification');


        $notification = $repository->findOneById($id);
        $form = $this->createForm(NotificationType::class, $notification);


        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($notification);
            $em->flush();

            //return $this->redirectToRoute('notification');
        }
        //return $this->render('notification/edit.html.twig', array('notification_edit' => $form->createView()));
    }

    /**
     * @Route("/notification/{id}/delete/", name="notification-delete")
     */

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $notification = $em->getRepository('AppBundle:Notification')->find($id);

        $em->remove($notification);
        $em->flush();

        //return $this->redirectToRoute('notification');
    }

}
