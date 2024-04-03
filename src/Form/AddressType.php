<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Label for address',
                'attr' => [
                    'placeholder' => 'ex: Home, Work, etc.'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'First name'
            ])
            ->add('lastname', TextType::class, [
                'label' =>'Last name'
            ])
            ->add('company', TextType::class, [
                'label' => 'Company (optional)',
                'required' => false,
            ])
            ->add('address', TextType::class, [
                'label' => 'Address',
                'attr' => [
                    'placeholder' => 'ex: 123 Example Street'
                ]
            ])
            ->add('postal', TextType::class, [
                'label' => 'Postal code'
            ])
            ->add('city', TextType::class, [
                'label' => 'City/Town'
            ])
            ->add('country', CountryType::class, [
                'label' => 'Country'
            ])
            ->add('phone', TelType::class, [
                'label' => 'Phone number'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Save address',
                'attr' => [
                    'class' => 'btn btn-info btn-block mt-2'
                ]

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
