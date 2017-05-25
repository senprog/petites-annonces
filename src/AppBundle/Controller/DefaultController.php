<?php

namespace AppBundle\Controller;

use Symfony\Component\Asset\Package;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="accueil")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //charge toutes les categories
        $categories = $em->getRepository('AnnonceBundle:categorieAnnonce')->findAll();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'categories' => $categories
        ]);
    }
}
