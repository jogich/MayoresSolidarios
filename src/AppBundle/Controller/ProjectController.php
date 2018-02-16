<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Entity\Project;
use AppBundle\Form\ProjectType;
use AppBundle\Entity\userProjectRelation;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use \DateTime;

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
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $date = new DateTime('now');
            $project->setDateCreate($date);

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

        $project = $repository->find($id);
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
     * @Method({"DELETE"})
     */
    public function deleteAction($id)
    {
      try{
        $em = $this->getDoctrine()->getManager();

        $project = $em->getRepository('AppBundle:Project')->find($id);

        $em->remove($project);
        $em->flush();

      } catch(\Exception $e){
        return new Response(
            'Fallo borrado',
            Response::HTTP_BAD_REQUEST,
            array('content-type' => 'text/html')
        );
      }
      return new Response(
          'OK',
          Response::HTTP_OK,
          array('content-type' => 'text/html')
      );
    }

    /**
     * @Route("/profile/{id}/project/", name="user-project")
     */
    public function userProjectsAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:User');

        $user = $repository->find($id);

        return $this->render('project/project-user.html.twig', array('user_info' => $user));
    }

    /**
     * @Route("/project/{project_id}/user/{user_id}", name="project-user")
     */
    public function infoUserAction($project_id, $user_id)
    {

        $exist = 2;
        $project = $this->getDoctrine()->getManager()->getRepository(Project::class)->find(intval($project_id));
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find(intval($user_id));

        if ($user->getRelation() == 0)
        {
            $exist = 0;
        } else {
            $exist = 1;
        }
        return $this->render('project/info-user.html.twig', array('project' => $project, 'exist' => $exist));
    }

    /**
     * @Route("/project/{project_id}/admin/", name="project-admin")
     */
    public function infoAdminAction($project_id)
    {
        $em = $this->getDoctrine()->getRepository(Project::class);

        $project = $em->find($project_id);

        return $this->render('project/info-admin.html.twig', array('project' => $project));
    }

    /**
     * @Route("/showProjects/", name="show-projects")
     */
    public function showProjectsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $project = $em->getRepository('AppBundle:Project')->findAll();

        return $this->render('project/showProjects.html.twig', array('projects' => $project));
    }
}
