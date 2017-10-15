<?php

namespace AnnonceBundle\Controller;

use AnnonceBundle\Entity\typeAnnonce;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Typeannonce controller.
 *
 * @Route("typeannonce")
 */
class typeAnnonceController extends Controller
{
    /**
     * Lists all typeAnnonce entities.
     *
     * @Route("/", name="typeannonce_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $typeAnnonces = $em->getRepository('AnnonceBundle:typeAnnonce')->findAll();

        return $this->render('typeannonce/index.html.twig', array(
            'typeAnnonces' => $typeAnnonces,
        ));
    }

    /**
     * Creates a new typeAnnonce entity.
     *
     * @Route("/new", name="typeannonce_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $typeAnnonce = new Typeannonce();
        $form = $this->createForm('AnnonceBundle\Form\typeAnnonceType', $typeAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeAnnonce);
            $em->flush($typeAnnonce);

            return $this->redirectToRoute('typeannonce_show', array('id' => $typeAnnonce->getId()));
        }

        return $this->render('typeannonce/new.html.twig', array(
            'typeAnnonce' => $typeAnnonce,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typeAnnonce entity.
     *
     * @Route("/{id}", name="typeannonce_show")
     * @Method("GET")
     */
    public function showAction(typeAnnonce $typeAnnonce)
    {
        $deleteForm = $this->createDeleteForm($typeAnnonce);

        return $this->render('typeannonce/show.html.twig', array(
            'typeAnnonce' => $typeAnnonce,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typeAnnonce entity.
     *
     * @Route("/{id}/edit", name="typeannonce_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, typeAnnonce $typeAnnonce)
    {
        $deleteForm = $this->createDeleteForm($typeAnnonce);
        $editForm = $this->createForm('AnnonceBundle\Form\typeAnnonceType', $typeAnnonce);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('typeannonce_edit', array('id' => $typeAnnonce->getId()));
        }

        return $this->render('typeannonce/edit.html.twig', array(
            'typeAnnonce' => $typeAnnonce,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a typeAnnonce entity.
     *
     * @Route("/{id}", name="typeannonce_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, typeAnnonce $typeAnnonce)
    {
        $form = $this->createDeleteForm($typeAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typeAnnonce);
            $em->flush($typeAnnonce);
        }

        return $this->redirectToRoute('typeannonce_index');
    }

    /**
     * Creates a form to delete a typeAnnonce entity.
     *
     * @param typeAnnonce $typeAnnonce The typeAnnonce entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(typeAnnonce $typeAnnonce)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('typeannonce_delete', array('id' => $typeAnnonce->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
