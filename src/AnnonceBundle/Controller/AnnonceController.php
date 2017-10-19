<?php

namespace AnnonceBundle\Controller;

use AnnonceBundle\Entity\Annonce;
use AnnonceBundle\Entity\Document;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Annonce controller.
 *
 * @Route("{_locale}/annonces")
 */
class AnnonceController extends Controller
{
    /**
     * Lists all annonce entities.
     *
     * @Route("/upload-test", name="upload-test")
     * @Method("GET")
     */
    public function uploadtestAction()
    {

        return $this->render('@Annonce/Annonce/upload.html.twig');
    }


    /**
     *
     * @Method({"GET", "POST"})
     * @Route("/ajax/snippet/image/send", name="ajax_snippet_image_send")
     */
    public function ajaxSnippetImageSendAction(Request $request)
    {
        $em = $this->container->get("doctrine.orm.default_entity_manager");

        $document = new Document();
        $media = $request->files->get('files');

        $document->setFile($media);
        $document->setPath($media->getPathName());
        $document->setName($media->getClientOriginalName());
        $document->upload();
        $em->persist($document);
        $em->flush();

        //infos sur le document envoyé
        //var_dump($request->files->get('file'));die;
        return new JsonResponse(array('success' => true));
    }



    /**
     * Lists all annonce entities.
     *
     * @Route("/", name="annonce_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $annonces = $em->getRepository('AnnonceBundle:Annonce')->findAll();

        return $this->render('annonce/index.html.twig', array(
            'annonces' => $annonces,
        ));
    }


    /**
     * Creates a new annonce entity.
     *
     * @Route("/new", name="annonce_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function newAction(Request $request)
    {
        $annonce = new Annonce();
        $form = $this->createForm('AnnonceBundle\Form\AnnonceType', $annonce);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $annonce->setUser($this->getUser());

            $em->persist($annonce);
            $em->flush($annonce);

            $this->addFlash('succes', $this->get('translator')->trans('agents.new.succes'));

            return $this->redirectToRoute('annonce_show', array('id' => $annonce->getId()));
        }

        return $this->render('annonce/new.html.twig', array(
            'annonce' => $annonce,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a annonce entity.
     *
     * @Route("/{id}", name="annonce_show")
     * @Method("GET")
     */
    public function showAction(Annonce $annonce)
    {
        $deleteForm = $this->createDeleteForm($annonce);

        return $this->render('annonce/show.html.twig', array(
            'annonce' => $annonce,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing annonce entity.
     *
     * @Route("/{id}/edit", name="annonce_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Annonce $annonce)
    {
        $deleteForm = $this->createDeleteForm($annonce);
        $editForm = $this->createForm('AnnonceBundle\Form\AnnonceType', $annonce);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('annonce_edit', array('id' => $annonce->getId()));
        }

        return $this->render('annonce/edit.html.twig', array(
            'annonce' => $annonce,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a annonce entity.
     *
     * @Route("/{id}", name="annonce_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Annonce $annonce)
    {
        $form = $this->createDeleteForm($annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($annonce);
            $em->flush($annonce);
        }

        return $this->redirectToRoute('annonce_index');
    }

    /**
     * Creates a form to delete a annonce entity.
     *
     * @param Annonce $annonce The annonce entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Annonce $annonce)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('annonce_delete', array('id' => $annonce->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    /**
     * Change the locale for the current user
     *
     * @param String $language
     * @return array
     *
     * @Route("/setlocale/{language}", name="setlocale")
     * @Template()
     */
    public function setLocaleAction($language = null, Request $request)
    {
        dump($request->getLocale());

        if($language != null or !empty($language))
        {
            // On enregistre la langue en session
            $this->get('session')->set('_locale', $language);
        }

        // on tente de rediriger vers la page d'origine
        $url = $request->headers->get('referer');

        if(empty($url))
        {
            return $this->redirectToRoute($this->generateUrl('annonce_index'));
        }

        return $this->redirect($url);
    }

}
