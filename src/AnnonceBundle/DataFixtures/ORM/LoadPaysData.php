<?php

    namespace AnnonceBundle\DataFixtures\ORM;

    use Doctrine\Common\DataFixtures\FixtureInterface;
    use Doctrine\Common\Persistence\ObjectManager;
    use AnnonceBundle\Entity\Pays;
    use Symfony\Component\DependencyInjection\ContainerAwareInterface;
    use Symfony\Component\DependencyInjection\ContainerInterface;

    class LoadVilleData implements FixtureInterface, ContainerAwareInterface
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
          /*  $pays = new Pays();
            $pays->setNom('');

            $manager->persist($pays);
            $manager->flush();*/
        }
    }