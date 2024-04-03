<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Carrier;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['user'];
        $builder
            ->add('addresses', EntityType::class, [
                'label' => false,
                'required' => true,
                'class' => Address::class,
                'choice_label' => 'addressLabel', //callback retrieving a concatenated string
                'choices' => $user->getAddresses(),
                'expanded' => true
            ])
            ->add('carriers', EntityType::class, [
                'label' => 'Choose your carrier',
                'required' => true,
                'class' => Carrier::class,
                'choice_label' => 'carrierLabel',
                'expanded' => true
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Proceed to checkout',
                'attr' => [
                    'class' => "btn btn-warning btn-block mt-3"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'user' => []       // Retrieve the user variable passed in the controller to pass it to the buildForm options
        ]);
    }
}
