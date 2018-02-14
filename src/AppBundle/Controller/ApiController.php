<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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

}
