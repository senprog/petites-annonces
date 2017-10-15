<?php

namespace AnnonceBundle\Controller;

use AnnonceBundle\Entity\statutAnnonce;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Statutannonce controller.
 *
 * @Route("statut-annonce")
 */
class statutAnnonceController extends Controller
{
    /**
     * Lists all statutAnnonce entities.
     *
     * @Route("/", name="statutannonce_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $statutAnnonces = $em->getRepository('AnnonceBundle:statutAnnonce')->findAll();

        return $this->render('statutannonce/index.html.twig', array(
            'statutAnnonces' => $statutAnnonces,
        ));
    }

    /**
     * Creates a new statutAnnonce entity.
     *
     * @Route("/new", name="statutannonce_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $statutAnnonce = new Statutannonce();
        $form = $this->createForm('AnnonceBundle\Form\statutAnnonceType', $statutAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($statutAnnonce);
            $em->flush($statutAnnonce);

            return $this->redirectToRoute('statutannonce_show', array('id' => $statutAnnonce->getId()));
        }

        return $this->render('statutannonce/new.html.twig', array(
            'statutAnnonce' => $statutAnnonce,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a statutAnnonce entity.
     *
     * @Route("/{id}", name="statutannonce_show")
     * @Method("GET")
     */
    public function showAction(statutAnnonce $statutAnnonce)
    {
        $deleteForm = $this->createDeleteForm($statutAnnonce);

        return $this->render('statutannonce/show.html.twig', array(
            'statutAnnonce' => $statutAnnonce,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing statutAnnonce entity.
     *
     * @Route("/{id}/edit", name="statutannonce_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, statutAnnonce $statutAnnonce)
    {
        $deleteForm = $this->createDeleteForm($statutAnnonce);
        $editForm = $this->createForm('AnnonceBundle\Form\statutAnnonceType', $statutAnnonce);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('statutannonce_edit', array('id' => $statutAnnonce->getId()));
        }

        return $this->render('statutannonce/edit.html.twig', array(
            'statutAnnonce' => $statutAnnonce,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a statutAnnonce entity.
     *
     * @Route("/{id}", name="statutannonce_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, statutAnnonce $statutAnnonce)
    {
        $form = $this->createDeleteForm($statutAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($statutAnnonce);
            $em->flush($statutAnnonce);
        }

        return $this->redirectToRoute('statutannonce_index');
    }

    /**
     * Creates a form to delete a statutAnnonce entity.
     *
     * @param statutAnnonce $statutAnnonce The statutAnnonce entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(statutAnnonce $statutAnnonce)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('statutannonce_delete', array('id' => $statutAnnonce->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
