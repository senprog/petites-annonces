<?php

namespace AnnonceBundle\Controller;

use AnnonceBundle\Entity\etatArticleAnnonce;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Etatarticleannonce controller.
 *
 * @Route("condition")
 */
class etatArticleAnnonceController extends Controller
{
    /**
     * Lists all etatArticleAnnonce entities.
     *
     * @Route("/", name="etatarticleannonce_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $etatArticleAnnonces = $em->getRepository('AnnonceBundle:etatArticleAnnonce')->findAll();

        return $this->render('etatarticleannonce/index.html.twig', array(
            'etatArticleAnnonces' => $etatArticleAnnonces,
        ));
    }

    /**
     * Creates a new etatArticleAnnonce entity.
     *
     * @Route("/new", name="etatarticleannonce_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $etatArticleAnnonce = new Etatarticleannonce();
        $form = $this->createForm('AnnonceBundle\Form\etatArticleAnnonceType', $etatArticleAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etatArticleAnnonce);
            $em->flush($etatArticleAnnonce);

            return $this->redirectToRoute('etatarticleannonce_show', array('id' => $etatArticleAnnonce->getId()));
        }

        return $this->render('etatarticleannonce/new.html.twig', array(
            'etatArticleAnnonce' => $etatArticleAnnonce,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a etatArticleAnnonce entity.
     *
     * @Route("/{id}", name="etatarticleannonce_show")
     * @Method("GET")
     */
    public function showAction(etatArticleAnnonce $etatArticleAnnonce)
    {
        $deleteForm = $this->createDeleteForm($etatArticleAnnonce);

        return $this->render('etatarticleannonce/show.html.twig', array(
            'etatArticleAnnonce' => $etatArticleAnnonce,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing etatArticleAnnonce entity.
     *
     * @Route("/{id}/edit", name="etatarticleannonce_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, etatArticleAnnonce $etatArticleAnnonce)
    {
        $deleteForm = $this->createDeleteForm($etatArticleAnnonce);
        $editForm = $this->createForm('AnnonceBundle\Form\etatArticleAnnonceType', $etatArticleAnnonce);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etatarticleannonce_edit', array('id' => $etatArticleAnnonce->getId()));
        }

        return $this->render('etatarticleannonce/edit.html.twig', array(
            'etatArticleAnnonce' => $etatArticleAnnonce,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a etatArticleAnnonce entity.
     *
     * @Route("/{id}", name="etatarticleannonce_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, etatArticleAnnonce $etatArticleAnnonce)
    {
        $form = $this->createDeleteForm($etatArticleAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($etatArticleAnnonce);
            $em->flush($etatArticleAnnonce);
        }

        return $this->redirectToRoute('etatarticleannonce_index');
    }

    /**
     * Creates a form to delete a etatArticleAnnonce entity.
     *
     * @param etatArticleAnnonce $etatArticleAnnonce The etatArticleAnnonce entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(etatArticleAnnonce $etatArticleAnnonce)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('etatarticleannonce_delete', array('id' => $etatArticleAnnonce->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
