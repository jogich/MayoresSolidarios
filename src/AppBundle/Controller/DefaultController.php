<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Project;

class DefaultController extends Controller
{
    /**
     * @Route("/{currentPage}", name="homepage")
     */
    public function showProjectsAction($currentPage = 1)
    {
        $limit=4;
        $repository = $this->getDoctrine()->getRepository(Project::class);
        $projects = $repository->allProjects($currentPage, $limit);
         $projectResult = $projects['paginator'];
         $projectQueryComplet =  $projects['query'];

         $maxPages = ceil($projects['paginator']->count() / $limit);
         return $this->render('default\index.html.twig', array(
               'project' => $projectResult,
               'maxPages'=>$maxPages,
               'thisPage' => $currentPage,
               'all_items' => $projectQueryComplet
           ) );
    }
}
