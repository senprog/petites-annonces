<?php

namespace AnnonceBundle\Form;

use AnnonceBundle\Entity\etatArticleAnnonce;
// use donjohn

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
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
            ->add('typeAnnonce', ChoiceType::class, array(
                'label' => 'agents.formulaire.type.annonce',
                'translation_domain' => 'agents',
                'multiple' => false,
                'expanded' => true,
                'choices' => array(
                    'Je vends' => 'vendre',
                    'J\'achete' => 'acheter',
                    'J\'echange' => 'echanger',
                    'Je fais don' => 'donner'
                ),
                'data' => 'vendre'
            ))

            ->add('titre', TextType::class, array(
                'label' => 'agents.formulaire.titre',
                'translation_domain' => 'agents',
                'attr' => [
                    'placeholder' => 'agents.formulaire.placeholder.titre'
                ]
            ))

            ->add('description', TextareaType::class, array(
                'label' => 'agents.formulaire.description',
                'translation_domain' => 'agents',
                'attr' => array(
                    'rows' => 8,
                    'class' => 'form-control',
                    'placeholder' => 'agents.formulaire.placeholder.description'
                )
            ))
           /* ->add('imageFile', VichImageType::class, [
                'required' => false
            ])*/


           // TODO: Implementer fonctionnalité de collection d'objet

           ->add('documents', CollectionType::class, array(
                   'entry_type' => DocumentType::class,
                   'allow_add' => false,
                   'allow_delete' => true,
               )
               /**
                * , FileType::class, array(
               'multiple' => true,
               'label' => 'Images',
               'required' => false,
               'attr' => [
               'class' => 'files',
               'data-msg-placeholder' => 'Selectionnez {files} à uploader...'
               ]
               )
                */
           )

            ->add('devise', EntityType::class, array(
                'class' => 'AnnonceBundle\Entity\devise',
                'multiple' => false,
                'expanded' => true,
                'label' => 'agents.formulaire.devise',
               'translation_domain' => 'agents'

            ))

            ->add('prix', TextType::class, array(
                'label' => 'agents.formulaire.prix',
                'translation_domain' => 'agents',
                'attr' => array(
                    'placeholder' => 'agents.formulaire.placeholder.prix'
                )
            ))

            ->add('typePrix', ChoiceType::class, array(
                'label' => 'agents.formulaire.typeprix',
                'translation_domain' => 'agents',
                'choices' => array(
                    'Negociable' => 'agents.formulaire.negociable',
                    'Non negociable' => 'agents.formulaire.nonnegociable',
                ),
                'choice_translation_domain' => true
            ))

            ->add('etatArticleAnnonce', EntityType::class, array(
                'class' => 'AnnonceBundle\Entity\etatArticleAnnonce',
                'choice_label' => 'nom',
                'label' => 'agents.formulaire.etat',
                'translation_domain' => 'agents',
                'multiple' => false,
                'expanded' => true
            ))

            ->add('adresseObjetVendu', TextType::class, array(
                'label' => 'agents.formulaire.lieu',
                'translation_domain' => 'agents',
                'attr' => [
                    'placeholder' => 'agents.formulaire.placeholder.ville',

                ]
            ))

            ->add( 'categorie', EntityType::class, array(
                'label' => 'agents.formulaire.categorie',
                    'translation_domain' => 'agents',
                    'class' => 'AnnonceBundle\Entity\categorieAnnonce',
                    'placeholder' => 'agents.formulaire.placeholder.categorie',

                )
            );


        $formModifier = function (FormInterface $form, categorieAnnonce $categorieAnnonce = null) {
            $positions = null === $categorieAnnonce ? array() : $categorieAnnonce->getSousCategorie();

            $form->add('sousCategorie', EntityType::class, array(
                    'class' => 'AnnonceBundle\Entity\sousCategorieAnnonce',
                    'label' => 'agents.formulaire.souscategorie',
                    'translation_domain' => 'agents',
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
                    'label' => 'agents.formulaire.souscategorie',
                    'translation_domain' => 'agents',
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
