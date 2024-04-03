<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Firstname',
                'constraints' => new Length(['min' => 3]),
                'attr' => [
                    'placeholder' => 'Ex: Lan, Anh, Hoa, etc.'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Lastname',
                'constraints' => new Length(['min' => 3]),
                'attr' => [
                    'placeholder' => 'Ex: Nguyen, Tran, Le, etc.'
                ]
            ])
            ->add('email', EmailType::class, [
                'constraints' => new Email(),
                'attr' => [
                    'placeholder' => 'someone@example.com'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Password and confirm password must be the same.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => [
                    'label' => 'Password',
                    'attr' => ['placeholder' => 'Enter your password']
                ],
                'second_options' => [
                    'label' => 'Repeat password',
                    'attr' => ['placeholder' => 'Confirm your password']
                ],
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Your password must contain at least 8 characters',
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Continue',
                'attr' => [
                    'class' => 'btn btn-outline-success'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
