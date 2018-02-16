<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Project;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function showProjectsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $project = $em->getRepository('AppBundle:Project')->findAll();

        return $this->render('default/index.html.twig', array('projects' => $project));
    }
}
