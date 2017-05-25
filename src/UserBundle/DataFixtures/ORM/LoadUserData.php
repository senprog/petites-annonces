<?php

    namespace UserBundle\DataFixtures\ORM;

    use Doctrine\Common\DataFixtures\FixtureInterface;
    use Doctrine\Common\Persistence\ObjectManager;
    use UserBundle\Entity\User;
    use Symfony\Component\DependencyInjection\ContainerAwareInterface;
    use Symfony\Component\DependencyInjection\ContainerInterface;

    class LoadUserData implements FixtureInterface, ContainerAwareInterface
    {

        /**
         * @var ContainerInterface
         */
        private $container;

        public function setContainer(ContainerInterface $container = null)
        {
            $this->container = $container;
        }

        public function load(ObjectManager $manager)
        {
            $userAdmin = new User();
            $userAdmin->setUsername('audrybab');
            $userAdmin->setNom('BABELA');
            $userAdmin->setPrenom('Audry');
            $userAdmin->setSalt(md5(uniqid()));
            // the 'security.password_encoder' service requires Symfony 2.6 or higher
            $encoder = $this->container->get('security.password_encoder');
            $password = $encoder->encodePassword($userAdmin, 'dane707');
            $userAdmin->setPassword($password);
            $userAdmin->setVille('Brazzaville');
            $userAdmin->setPays('CG');

            $userAdmin->setEmail('contact@congo-market.com');
            $userAdmin->setRoles(['ROLE_ADMIN']);

            $manager->persist($userAdmin);
            $manager->flush();
        }
    }