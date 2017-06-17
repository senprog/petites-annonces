<?php

namespace AnnonceBundle\Form;

use AnnonceBundle\Entity\etatArticleAnnonce;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Vich\UploaderBundle\Form\Type\VichImageType;


use Jb\Bundle\FileUploaderBundle\Form\Type\ImageAjaxType;

use AnnonceBundle\Entity\categorieAnnonce;
use AnnonceBundle\Entity\sousCategorieAnnonce;

class AnnonceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('typeAnnonce', EntityType::class, array(
                'class' => 'AnnonceBundle\Entity\typeAnnonce',
                'label' => 'Type d\'annonce',
                'multiple' => false,
                'expanded' => true
            ))
            ->add('titre', TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Exemple: playstation 3'
                )
            ))
            ->add('description', TextareaType::class, array(
                'label' => 'Description',
                'attr' => array(
                    'rows' => 8,
                    'class' => 'form-control'
                )
            ))
           /* ->add('imageFile', VichImageType::class, [
                'required' => false
            ])*/
           /* ->add('photo2')
            ->add('photo3')
            ->add('photo4')
            ->add('photo5')
            ->add('photo6')*/
            ->add('devise', EntityType::class, array(
                'class' => 'AnnonceBundle\Entity\devise',
                'multiple' => false,
                'expanded' => true,
                'label' => 'Devise'

            ))
            ->add('prix', TextType::class, array(
                'label' => 'Prix',
                'attr' => array(
                    'placeholder' => 'Exemple : 1.500.000'
                )
            ))
            ->add('typePrix', ChoiceType::class, array(
                'choices' => array(
                    'Negociable' => 'Negociable',
                    'Non negociable' => 'Non négociable'
                )
            ))
            ->add('etatArticleAnnonce', EntityType::class, array(
                'class' => 'AnnonceBundle\Entity\etatArticleAnnonce',
                'choice_label' => 'nom',
                'label' => 'Etat',
                'multiple' => false,
                'expanded' => true
            ))
            ->add('adresseObjetVendu', TextType::class, array(
                'attr' => [
                    'placeholder' => 'Ville '
                ]
            ))




            ->add(
                'categorie',
                EntityType::class,
                array(
                    'class' => 'AnnonceBundle\Entity\categorieAnnonce',
                    'placeholder' => ' Selectionnez une catégorie ',
                )
            );


        $formModifier = function (FormInterface $form, categorieAnnonce $categorieAnnonce = null) {
            $positions = null === $categorieAnnonce ? array() : $categorieAnnonce->getSousCategorie();

            $form->add('sousCategorie', EntityType::class, array(
                    'class' => 'AnnonceBundle\Entity\sousCategorieAnnonce',
                    'placeholder' => '',
                    'choices' => $positions
                )
            );
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();

                $formModifier($event->getForm(), $data->getCategorie());
            }
        );

        $builder->get('categorie')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $categorieAnnonce = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $categorieAnnonce);
            }
        );

        $builder
            ->add(
                'sousCategorie',
                EntityType::class,
                [
                    'label' => 'sous categorie',
                    'class' => 'AnnonceBundle\Entity\sousCategorieAnnonce'
                ]
            );

    }


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AnnonceBundle\Entity\Annonce'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'annoncebundle_annonce';
    }


}
