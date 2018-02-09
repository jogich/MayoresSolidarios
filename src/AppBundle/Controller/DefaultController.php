<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $repository1 = $this->getDoctrine()->getManager()->getRepository('AppBundle:Notification');
        $repository2 = $this->getDoctrine()->getManager()->getRepository('AppBundle:User');

        $notification = $repository1->countNotifications();
        $test = $repository2->countUsers();

        return $this->render('default/index.html.twig', array('count_Notification' => $notification, 'count_Users' => $test));
    }

}
