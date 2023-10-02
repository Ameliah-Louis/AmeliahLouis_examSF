<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'admin' => 'ROLE_ADMIN',
                    'user' => 'ROLE_USER'
                ]])
            ->add('password')
            ->add('firstname')
            ->add('lastname')
            ->add('personnal_picture')
            // ->add('departement')
            ->add('departement', ChoiceType::class, [
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'CDI' => 'CONTRACT_TYPE_CDI',
                    'CDD' => 'CONTRACT_TYPE_CDD',
                    'Intérim' => 'CONTRACT_TYPE_INTERIM'
                ]])
            ->add('contract_type')
            ->add('contract_end')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
