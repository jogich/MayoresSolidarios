<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Entity\Project;
use AppBundle\Form\ProjectType;
use AppBundle\Entity\userProjectRelation;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProjectController extends Controller
{

    /**
     * @Route("/project/", name="project")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $project = $em->getRepository('AppBundle:Project')->findAll();

        return $this->render('project/index.html.twig', array('projects' => $project));
    }

    /**
     * @Route("/project/new/", name="project-new")
     */
    public function newAction(Request $request)
    {
        $project = new Project();
        $form= $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $project = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('project');
        }

        return $this->render('project/new.html.twig', array('project_new' => $form->createView()));
    }

    /**
     * @Route("/project/{id}/edit/", name="project-edit")
     */
    public function editAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Project');

        $project = $repository->findOneById($id);
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('project');

        }

        return $this->render('project/edit.html.twig', array('project_edit' => $form->createView()));
    }

    /**
     * @Route("/project/{id}/delete/", name="project-delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $project = $em->getRepository('AppBundle:Project')->findOneById($id);

        $em->remove($project);
        $em->flush();

        return $this->redirectToRoute('project');
    }

    /**
     * @Route("/profile/{id}/project/", name="user-projects")
     */
    public function yourProjectsAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:User');

        $user = $repository->find($id);

        return $this->render('project/project-user.html.twig', array('user_info' => $user));
    }

}
