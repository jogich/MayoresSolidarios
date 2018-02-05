<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\UserType;

class UserController extends Controller
{
    /**
     * @Route("/", name="")
     */
    public function indexAction()
    {
        
    }

    /**
     * @Route("/user/", name="")
     */
    public function showAction()
    {

    }

    /**
     * @Route("/user/new/", name="user-new")
     */
    public function newAction()
    {

    }

    /**
     * @Route("/user/{id}/update/", name="user-edit")
     */
    public function editAction()
    {

    }

    /**
     * @Route("/user/{id}/delete/", name="user-delete")
     */
    public function deleteAction()
    {

    }
}
