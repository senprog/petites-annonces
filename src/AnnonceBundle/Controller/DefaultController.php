<?php

namespace AnnonceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function succesAction()
    {
        return $this->render('AnnonceBundle:Default:succes.html.twig');
    }

    public function contactAction()
    {
        return $this->render('AnnonceBundle:Default:contact.html.twig');
    }

    public function faqAction()
    {
        return $this->render('AnnonceBundle:Default:faq.html.twig');
    }

}
