<?php

namespace AnnonceBundle\Controller;

use AnnonceBundle\Entity\devise;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Devise controller.
 *
 * @Route("devise")
 */
class deviseController extends Controller
{
    /**
     * Lists all devise entities.
     *
     * @Route("/", name="devise_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $devises = $em->getRepository('AnnonceBundle:devise')->findAll();

        return $this->render('devise/index.html.twig', array(
            'devises' => $devises,
        ));
    }

    /**
     * Creates a new devise entity.
     *
     * @Route("/new", name="devise_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $devise = new Devise();
        $form = $this->createForm('AnnonceBundle\Form\deviseType', $devise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($devise);
            $em->flush($devise);

            return $this->redirectToRoute('devise_show', array('id' => $devise->getId()));
        }

        return $this->render('devise/new.html.twig', array(
            'devise' => $devise,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a devise entity.
     *
     * @Route("/{id}", name="devise_show")
     * @Method("GET")
     */
    public function showAction(devise $devise)
    {
        $deleteForm = $this->createDeleteForm($devise);

        return $this->render('devise/show.html.twig', array(
            'devise' => $devise,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing devise entity.
     *
     * @Route("/{id}/edit", name="devise_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, devise $devise)
    {
        $deleteForm = $this->createDeleteForm($devise);
        $editForm = $this->createForm('AnnonceBundle\Form\deviseType', $devise);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('devise_edit', array('id' => $devise->getId()));
        }

        return $this->render('devise/edit.html.twig', array(
            'devise' => $devise,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a devise entity.
     *
     * @Route("/{id}", name="devise_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, devise $devise)
    {
        $form = $this->createDeleteForm($devise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($devise);
            $em->flush($devise);
        }

        return $this->redirectToRoute('devise_index');
    }

    /**
     * Creates a form to delete a devise entity.
     *
     * @param devise $devise The devise entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(devise $devise)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('devise_delete', array('id' => $devise->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
