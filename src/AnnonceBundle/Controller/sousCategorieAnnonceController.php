<?php

namespace AnnonceBundle\Controller;

use AnnonceBundle\Entity\sousCategorieAnnonce;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Souscategorieannonce controller.
 *
 * @Route("sous-categories-annonces")
 */
class sousCategorieAnnonceController extends Controller
{
    /**
     * Lists all sousCategorieAnnonce entities.
     *
     * @Route("/", name="souscategorieannonce_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sousCategorieAnnonces = $em->getRepository('AnnonceBundle:sousCategorieAnnonce')->findAll();

        return $this->render('souscategorieannonce/index.html.twig', array(
            'sousCategorieAnnonces' => $sousCategorieAnnonces,
        ));
    }

    /**
     * Creates a new sousCategorieAnnonce entity.
     *
     * @Route("/new", name="souscategorieannonce_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $sousCategorieAnnonce = new Souscategorieannonce();
        $form = $this->createForm('AnnonceBundle\Form\sousCategorieAnnonceType', $sousCategorieAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sousCategorieAnnonce);
            $em->flush($sousCategorieAnnonce);

            return $this->redirectToRoute('souscategorieannonce_show', array('id' => $sousCategorieAnnonce->getId()));
        }

        return $this->render('souscategorieannonce/new.html.twig', array(
            'sousCategorieAnnonce' => $sousCategorieAnnonce,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sousCategorieAnnonce entity.
     *
     * @Route("/{id}", name="souscategorieannonce_show")
     * @Method("GET")
     */
    public function showAction(sousCategorieAnnonce $sousCategorieAnnonce)
    {
        $deleteForm = $this->createDeleteForm($sousCategorieAnnonce);

        return $this->render('souscategorieannonce/show.html.twig', array(
            'sousCategorieAnnonce' => $sousCategorieAnnonce,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sousCategorieAnnonce entity.
     *
     * @Route("/{id}/edit", name="souscategorieannonce_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, sousCategorieAnnonce $sousCategorieAnnonce)
    {
        $deleteForm = $this->createDeleteForm($sousCategorieAnnonce);
        $editForm = $this->createForm('AnnonceBundle\Form\sousCategorieAnnonceType', $sousCategorieAnnonce);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('souscategorieannonce_edit', array('id' => $sousCategorieAnnonce->getId()));
        }

        return $this->render('souscategorieannonce/edit.html.twig', array(
            'sousCategorieAnnonce' => $sousCategorieAnnonce,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sousCategorieAnnonce entity.
     *
     * @Route("/{id}", name="souscategorieannonce_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, sousCategorieAnnonce $sousCategorieAnnonce)
    {
        $form = $this->createDeleteForm($sousCategorieAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sousCategorieAnnonce);
            $em->flush($sousCategorieAnnonce);
        }

        return $this->redirectToRoute('souscategorieannonce_index');
    }

    /**
     * Creates a form to delete a sousCategorieAnnonce entity.
     *
     * @param sousCategorieAnnonce $sousCategorieAnnonce The sousCategorieAnnonce entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(sousCategorieAnnonce $sousCategorieAnnonce)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('souscategorieannonce_delete', array('id' => $sousCategorieAnnonce->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
