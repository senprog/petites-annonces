<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class UserController extends Controller
{
    /**
     * @Route("/inscription", name="user_inscription")
     * Permet l'inscription des users via le formulaire d'inscription
     */
    public function registerAction(Request $request)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $user->setRoles(['ROLE_USER']);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            $this->addFlash('succe', 'Votre compte a été créé avec succè ! Merci d\'activer votre compte en cliquant sur le lien envoyé dans votre boite mail.');
            return $this->redirectToRoute('annonce_succe');
        }

        return $this->render(
            '@Annonce/Default/inscription.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * Displays a form to edit an existing ville entity.
     *
     * @Route("/mon-profil/edit", name="user_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function editUserAction(Request $request, User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('UserBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', array('id' => $user->getId()));
        }

        return $this->render('@Annonce/Profiles/profile.html.twig', array(
            'user' => $user,
            'test' => 'bonjour',
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * @Route("/mon-profile", name="user_profile")
     *  @Method({"GET", "POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function monProfilAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->findOneBy(['username' => $this->getUser()->getUsername()]);
        $editForm = $this->createForm('UserBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', array('id' => $user->getId()));
        }


        return $this->render('@Annonce/Profiles/profile.html.twig', array(
            'edit_form' => $editForm->createView(),
            'profile' => $this->getUser()
        ));
    }

    /*
     * Met à jour la derniere date de connection du user
     */
    public function updateDateLastLogin($id)
    {
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository('UserBundle:User')->findOneBy(['id' => $id]);


        if($profile){

            $profile->setLastLogin(new \DateTime());

        }

        return $this->render('@Annonce/Profiles/profile.html.twig', array(
            'profile' => $this->getUser()
        ));
    }
}
