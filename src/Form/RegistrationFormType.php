<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;

class RegistrationFormType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('gender', ChoiceType::class, [
                'choices'  => [
                    'F' => 1,
                    'H' => 2,
                    'Autre' => 3,
                ],
            ])
            ->add('birthdate', BirthdayType::class, [
                'placeholder' => [
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                ]
            ]);
    }

    public function getParent()
    {
        return BaseRegistrationFormType::class;
    }


}
