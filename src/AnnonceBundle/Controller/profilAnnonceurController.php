<?php

namespace AnnonceBundle\Controller;

use AnnonceBundle\Entity\profilAnnonceur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Profilannonceur controller.
 *
 * @Route("profil-annonceur")
 */
class profilAnnonceurController extends Controller
{
    /**
     * Lists all profilAnnonceur entities.
     *
     * @Route("/", name="profilannonceur_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $profilAnnonceurs = $em->getRepository('AnnonceBundle:profilAnnonceur')->findAll();

        return $this->render('profilannonceur/index.html.twig', array(
            'profilAnnonceurs' => $profilAnnonceurs,
        ));
    }

    /**
     * Creates a new profilAnnonceur entity.
     *
     * @Route("/new", name="profilannonceur_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $profilAnnonceur = new Profilannonceur();
        $form = $this->createForm('AnnonceBundle\Form\profilAnnonceurType', $profilAnnonceur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($profilAnnonceur);
            $em->flush($profilAnnonceur);

            return $this->redirectToRoute('profilannonceur_show', array('id' => $profilAnnonceur->getId()));
        }

        return $this->render('profilannonceur/new.html.twig', array(
            'profilAnnonceur' => $profilAnnonceur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a profilAnnonceur entity.
     *
     * @Route("/{id}", name="profilannonceur_show")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAction(profilAnnonceur $profilAnnonceur)
    {
        $deleteForm = $this->createDeleteForm($profilAnnonceur);

        return $this->render('profilannonceur/show.html.twig', array(
            'profilAnnonceur' => $profilAnnonceur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing profilAnnonceur entity.
     *
     * @Route("/{id}/edit", name="profilannonceur_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, profilAnnonceur $profilAnnonceur)
    {
        $deleteForm = $this->createDeleteForm($profilAnnonceur);
        $editForm = $this->createForm('AnnonceBundle\Form\profilAnnonceurType', $profilAnnonceur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profilannonceur_edit', array('id' => $profilAnnonceur->getId()));
        }

        return $this->render('profilannonceur/edit.html.twig', array(
            'profilAnnonceur' => $profilAnnonceur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a profilAnnonceur entity.
     *
     * @Route("/{id}", name="profilannonceur_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, profilAnnonceur $profilAnnonceur)
    {
        $form = $this->createDeleteForm($profilAnnonceur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($profilAnnonceur);
            $em->flush($profilAnnonceur);
        }

        return $this->redirectToRoute('profilannonceur_index');
    }

    /**
     * Creates a form to delete a profilAnnonceur entity.
     *
     * @param profilAnnonceur $profilAnnonceur The profilAnnonceur entity
     *
     * @return \Symfony\Component\Form\Form The form
     * @Security("has_role('ROLE_ADMIN')")
     */
    private function createDeleteForm(profilAnnonceur $profilAnnonceur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('profilannonceur_delete', array('id' => $profilAnnonceur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
