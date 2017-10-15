<?php

namespace AnnonceBundle\Controller;

use AnnonceBundle\Entity\categorieAnnonce;
use Buzz\Message\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Categorieannonce controller.
 *
 * @Route("categories-annonces")
 */
class categorieAnnonceController extends Controller
{
    /**
     * Lists all categorieAnnonce entities.
     *
     * @Route("/", name="categorieannonce_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorieAnnonces = $em->getRepository('AnnonceBundle:categorieAnnonce')->findAll();

        return $this->render('categorieannonce/index.html.twig', array(
            'categorieAnnonces' => $categorieAnnonces,
        ));
    }

    /**
     * Creates a new categorieAnnonce entity.
     *
     * @Route("/new", name="categorieannonce_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $categorieAnnonce = new Categorieannonce();
        $form = $this->createForm('AnnonceBundle\Form\categorieAnnonceType', $categorieAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorieAnnonce);
            $em->flush($categorieAnnonce);

            return $this->redirectToRoute('categorieannonce_show', array('id' => $categorieAnnonce->getId(), 'nom'=> $categorieAnnonce->getNom() ));
        }

        return $this->render('categorieannonce/new.html.twig', array(
            'categorieAnnonce' => $categorieAnnonce,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing categorieAnnonce entity.
     *
     * @Route("/edit/{id}", name="categorieannonce_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, categorieAnnonce $categorieAnnonce)
    {
        $deleteForm = $this->createDeleteForm($categorieAnnonce);
        $editForm = $this->createForm('AnnonceBundle\Form\categorieAnnonceType', $categorieAnnonce);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorieannonce_edit', array('id' => $categorieAnnonce->getId()));
        }

        return $this->render('categorieannonce/edit.html.twig', array(
            'categorieAnnonce' => $categorieAnnonce,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Finds and displays a categorieAnnonce entity.
     *
     * @Route("/{id}/{nom}", name="categorieannonce_show")
     * @Method("GET")
     */
    public function showAction(categorieAnnonce $categorieAnnonce)
    {
        $deleteForm = $this->createDeleteForm($categorieAnnonce);

        return $this->render('categorieannonce/show.html.twig', array(
            'categorieAnnonce' => $categorieAnnonce,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categorieAnnonce entity.
     *
     * @Route("/{id}", name="categorieannonce_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, categorieAnnonce $categorieAnnonce)
    {
        $form = $this->createDeleteForm($categorieAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorieAnnonce);
            $em->flush($categorieAnnonce);
        }

        return $this->redirectToRoute('categorieannonce_index');
    }

    /**
     * Creates a form to delete a categorieAnnonce entity.
     *
     * @param categorieAnnonce $categorieAnnonce The categorieAnnonce entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(categorieAnnonce $categorieAnnonce)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categorieannonce_delete', array('id' => $categorieAnnonce->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Nombre d'annonce dans une categorie et ces sous categories
     *
     * @Route("/{id}", name="categorieannonce_nombre")
     */

    public function nombreAnnoncesAction($idCategorie){

        $em = $this->getDoctrine()->getManager();
        $nombre = $em->getRepository('AnnonceBundle:Annonce');
       /* $qb = $em->createQueryBuilder();
        $qb->select('count()')*/
        return new  \Symfony\Component\HttpFoundation\Response(256);
    }
}
