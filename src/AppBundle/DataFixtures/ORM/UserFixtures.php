<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Tests\Common\DataFixtures\TestFixtures\UserFixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use \DateTime;


class UserFixtures implements FixtureInterface {

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $user = new User();
        $user->setName('user');
        $user->setSurname('user');
        $user->setRoles(array('ROLE_USER'));
        $user->setAddress('user');
        $user->setPhoneNumber('696969');
        $user->setEmail('user@test.com');

        $date = new DateTime('now');
        $user->setBirthday($date);

        $password = $this->encoder->encodePassword($user, 'user');
        $user->setPassword($password);

        $manager->persist($user);

        $manager->flush();


        $userAdmin = new User();

        $userAdmin->setName('admin');
        $userAdmin->setSurname('admin');
        $userAdmin->setRoles(array('ROLE_ADMIN'));
        $userAdmin->setAddress('admin');
        $userAdmin->setPhoneNumber('696969');
        $userAdmin->setEmail('admin@test.com');

        $date = new DateTime('now');
        $userAdmin->setBirthday($date);

        $password = $this->encoder->encodePassword($user, 'admin');
        $userAdmin->setPassword($password);

        $manager->persist($userAdmin);

        $manager->flush();
    }
}

