<?php

namespace UserBundle\Form;

use AnnonceBundle\AnnonceBundle;
use AnnonceBundle\Entity\ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('email', EmailType::class)
            ->add('username', TextType::class)
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Nouveau pasword',
                    'attr' => array('placeholder' => 'nouveau mot de passe')),
                'second_options' => array('label' => 'Repetez password',
                    'attr' => array('placeholder' => 'Repetez mot de passe')),
            ))
            ->add('pays', CountryType::class, array(
                            'placeholder' => 'Selectionnez un pays',
                            'preferred_choices' => array( 'CG', 'CD' )
            ))
            ->add('ville', EntityType::class, array(
                'class' => 'AnnonceBundle\Entity\ville',
                'choice_label' => 'nom',
                'placeholder' => 'Selectionnez votre ville',
                'preferred_choices' => array('Brazzaville','Kinshasa')
            ))
            ->add('recaptcha', EWZRecaptchaType::class, [
                'language' => 'fr',
                'attr' => array(
                    'options' => array(
                        'theme' => 'light',
                        //'type'  => 'image',
                        'size'  => 'normal'
                    )
                )
            ]);
//            ->add('termsAccepted', CheckboxType::class, array(
//                'mapped' => false,
//                'constraints' => new IsTrue(),
//            ))
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));

    }

    public function getBlockPrefix()
    {
        return 'user_bundle_user_type';
    }
}
