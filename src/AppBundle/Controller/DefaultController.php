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
    public function indexAction()
    {
        $limit=4;
        $repository = $this->getDoctrine()->getRepository(Project::class);
        $project = $repository->findAll();
        
         return $this->render('default\index.html.twig', array(
               'project' => $project,
           ) );
    }
    /**
     * @Route("/landing/", name="landing")
     */
    public function landingAction()
    {
        return $this->render('default/landing.html.twig');
    }
}
