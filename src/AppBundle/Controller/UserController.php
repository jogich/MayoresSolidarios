<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Entity\Project;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Validator\Constraints\DateTime;

class UserController extends Controller
{
    /**
     * @Route("/user/", name="user")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:User')->findAll();

        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'No puede acceder a esta página.');

        return $this->render('user/index.html.twig', array('users' => $users));
    }

    /**
     * @Route("/user/new/", name="user-new")
     */
    public function newAction(Request $request)
    {
        $user = new User;
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'No puede acceder a esta página.');

        if ($form->isValid() && $form->isSubmitted()) {

            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPlainPassword());

            $user->setPassword($password);
            $user->setRoles(array('ROLE_USER'));

            $date = new \DateTime('now');
            $user->setDateCreate($date);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user');
        }

        return $this->render('user/new.html.twig', array('user_new' => $form->createView()));
    }

    /**
     * @Route("/user/{id}/edit/", name="user-edit")
     */
    public function editAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:User');

        $user = $repository->find($id);
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted())
        {
            $date = new \DateTime('now');
            $user->setDateUpdate($date);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $response = $this->forward('AppBundle:User:profile', array('email'  => $user->getEmail()));
            return $response;
        }

        return $this->render('user/edit.html.twig', array('user_edit' => $form->createView(), 'user_id' => $id));
    }

    /**
     * @Route("/user/{id}/delete/", name="user-delete" )
     * @Method({"DELETE"})
     */
    public function deleteAction(Request $request, $id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'No puede realizar esta acción.');

      try{
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:User')->find($id);

        $em->remove($user);
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
     * @Route("/user/{email}/profile/", name="user-profile")
     */
    public function profileAction($email)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:User')->findOneByEmail($email);

        return $this->render('user/profile.html.twig', array('user_info' => $user));
    }

    /**
     * @Route("/user/{user_id}/project/{project_id}/add", name="user-project-add")
     */
    public function userProjectAddAction($user_id,$project_id)
    {
        $em = $this->getDoctrine()->getManager();

        $project = $this->getDoctrine()->getManager()->getRepository(Project::class)->find(intval($project_id));
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find(intval($user_id));

        $actual_members = $project->getActualMembers();
        $project->setActualMembers($actual_members+1);

        $users = $project->getUsers();

        if ($users == null) {
            array_push($users,$user_id);
            $project->setUsers($users);
        } else {
            foreach ($users as $value) {
                if ($value == $user_id) {

                } else {
                    array_push($users,$user_id);
                    $project->setUsers($users);
                }
            }
        }

        $em->persist($project);
        $em->flush();

        $user->addProjectId($project);

        $em->persist($user);
        $em->flush();

        $response = $this->forward('AppBundle:Project:infoUser', array('project_id'  => $project_id, 'user_id' => $user_id));

        return $response;
    }

    /**
     * @Route("/user/{user_id}/project/{project_id}/delete", name="user-project-delete")
     */
    public function userProjectRemoveAction($user_id,$project_id)
    {
        $em = $this->getDoctrine()->getManager();

        $project = $this->getDoctrine()->getManager()->getRepository(Project::class)->find(intval($project_id));
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find(intval($user_id));

        $user->removeProjectId($project);

        $users = $project->getUsers();

        foreach ($users as $key => $value)
        {
            if ($value == $user_id){
                $k = $key;
            }
        }

        unset($users[$k]);

        $project->setUsers($users);

        $actual_members = $project->getActualMembers();
        $project->setActualMembers($actual_members-1);

        $em->persist($project);
        $em->flush();

        $em->persist($user);
        $em->flush();

        $response = $this->forward('AppBundle:Project:infoUser', array('project_id'  => $project_id, 'user_id' => $user_id));

        return $response;
    }
}
