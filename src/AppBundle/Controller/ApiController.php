<?php

namespace AppBundle\Controller;

use Doctrine\Tests\Common\DataFixtures\TestFixtures\UserFixture;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\User;
use AppBundle\Entity\Project;


class ApiController extends Controller
{
    /**
     * @Route("/api/project/{id}/delete/", name="api-delete-project")
     *
     */
    public function deleteProjectAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('AppBundle:Project')->find($id);

        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        if (empty($project)) {
            $jsonContent = $serializer->serialize(array('code' => 400, 'message' => 'Project doesnt exist'), 'json');
            $response = JsonResponse::fromJsonString($jsonContent);
        } else {
            $em->remove($project);
            $em->flush();

            $jsonContent = $serializer->serialize(array('code' => 200, 'Deleted succesfully'), 'json');
            $response = JsonResponse::fromJsonString($jsonContent);
        }

        return $response;
    }

    /**
     * @Route("/api/user/{id}/delete/", name="api-delete-user")
     *
     */
    public function deleteUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);

        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        if (empty($user)) {
            $jsonContent = $serializer->serialize(array('code' => 400, 'message' => 'User doesnt exist'), 'json');
            $response = JsonResponse::fromJsonString($jsonContent);
        } else {
            $em->remove($user);
            $em->flush();

            $jsonContent = $serializer->serialize(array('code' => 200, 'Deleted succesfully'), 'json');
            $response = JsonResponse::fromJsonString($jsonContent);
        }

        return $response;
    }

    /**
     * @Route("/api/user/{user_id}/project/{project_id}", name="api-delete-user")
     *
     */
    public function participateUserAction($user_id, $project_id)
    {
        $em = $this->getDoctrine()->getManager();

        $user= new User();
        $project = new Project();

        $user_repository = $em->getRepository('AppBundle:User')->find($user_id);
        $project_repository = $em->getRepository('AppBundle:Project')->find($project_id);
        var_dump($user->getGroupId($project_id));
        var_dump($project->getGroupId($project_id));


        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        if (empty($user_id || $project_id)) {
            $jsonContent = $serializer->serialize(array('code' => 400, 'message' => 'User or project doesnt exist'), 'json');
            $response = JsonResponse::fromJsonString($jsonContent);
        } else {
            $user->addGroupId($project_repository);
            $project->addUserId($user_repository);
            $jsonContent = $serializer->serialize(array('code' => 200, 'Deleted succesfully'), 'json');
            $response = JsonResponse::fromJsonString($jsonContent);
        }

        return $response;
    }

}
