<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //Type mis en commentaire, j'aurais du les définirs à la création du User, mais trop de noeuds, j'ai pas le courage de tout recommencer à 23h...
            ->add('email') //, EmailType::class,
            ->add('roles', ChoiceType::class, [ 
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'admin' => 'ROLE_ADMIN',
                    'employé•e' => 'ROLE_USER'
                ]])
            ->add('password') 
            // Normalement le code ci dessous devrait marcher, mais j'ai une erreur de Type, je sais pas d'ou ça vient.
            //
            // ->add('plainPassword', RepeatedType::class, [
            //     'mapped' => false,
            //     'type' => PasswordType::class,
            //     'invalid_message' => 'The password fields must match.',
            //     'options' => ['attr' => ['class' => 'password-field']],
            //     'required' => true,
            //     'first_options'  => ['label' => 'Password'],
            //     'second_options' => ['label' => 'Repeat Password'],
            //     'constraints' => [
            //         new NotBlank([
            //             'message' => 'Please enter a password',
            //         ]),
            //         new Length([
            //             'min' => 6,
            //             'minMessage' => 'Your password should be at least {{ limit }} characters',
            //             // max length allowed by Symfony for security reasons
            //             'max' => 4096,
            //         ]),
            //     ],
            // ])
            ->add('firstname') //, TextType::class,
            ->add('lastname') //, TextType::class,
            ->add('personnal_picture')
            //Problème dans le form "The selected choice is invalid" apparait par défaut au dessus du selecteur de choix.
            ->add('departement', ChoiceType::class, [
                'choices' => [
                    'Sélection du département' => 'departement',
                    'RH' => 'RH',
                    'DIRECTION ' => 'DIRECTION',
                    'INFORMATIQUE' => 'INFORMATIQUE',
                    'COMPTABILITE' => 'COMPTABILITE',
                ]])
            //Problème dans le form "The selected choice is invalid" apparait par défaut au dessus du selecteur de choix.
            //->add('foo', 'choice', array(
            // 'choices' => array($obj1, $obj2),
            // 'choice_labels' => 'name',
            // 'choice_values' => 'id',
            ->add('contract_type', ChoiceType::class, [
                'choices' => [
                    'Type de Contrat' => 'contract_type',
                    'CDI' => 'CDI',
                    'CDD' => 'CDD',
                    'INTERIM' => 'INTERIM',
                ]])
            ->add('contract_end') //, DateType::class,
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
