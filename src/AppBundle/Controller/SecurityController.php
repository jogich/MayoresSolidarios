<?php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Doctrine\ORM\EntityManager;

class SecurityController extends Controller
{
    /**
     * @Route("/login/", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('security/login.html.twig', array('error' => $error));
    }

    /**
     * @Route("/register/", name="register")
     */
    public function registerAction(Request $request)
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

        return $this->render('security/register.html.twig', array('user_new' => $form->createView()));
    }

    /**
     * @Route("/logout/", name="logout")
     */
    public function logoutAction()
    {

    }
}