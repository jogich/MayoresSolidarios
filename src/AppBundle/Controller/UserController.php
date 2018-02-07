<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Doctrine\ORM\EntityManager;

class UserController extends Controller
{
    /**
     * @Route("/user/", name="user")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:User')->findAll();

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

        if ($form->isValid() && $form->isSubmitted()) {

            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPlainPassword());

            $user->setPassword($password);
            $user->setRoles(array('ROLE_USER'));
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

        $user = $repository->findOneById($id);
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user');
        }

        return $this->render('user/edit.html.twig', array('user_edit' => $form->createView()));
    }

    /**
     * @Route("/user/{id}/delete/", name="user-delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:User')->findOneById($id);

        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('user');
    }

    /**
     * @Route("/user/{id}/profile/", name="user-profile")
     */
    public function profileAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:User')->findOneById($id);

        return $this->render('user/profile.html.twig', array('user_info' => $user));
    }
}