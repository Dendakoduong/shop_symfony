<?php

namespace App\Form;

use App\Entity\Category;
use App\Model\Search;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Search form on product page
 */
class SearchType extends AbstractType
{

    /**
     * Allows you to set up a custom form
     *
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('string', TextType::class, [
                'label' => 'Search on Banazon',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Enter keywords'
                ]
            ])
            ->add('categories', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('priceRange', RangeType::class, [
                'attr' => [
                    'min' => 10,
                    'max' => 10000, // multiply by 100 to convert to cents
                    'step' => 10, // multiply by 100 to convert to cents
                    'oninput' => 'updatePriceLabel(this.value)',
                    'id' => 'priceRangeSlider',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => '<i class="fas fa-arrow-right"></i>',
                'attr' => [
                    'class' => 'btn btn-outline-info w-100',
                    'aria-label' => 'Submit',
                    'style' => 'background-image: linear-gradient(to right, #FFDE79, #FFC34D); color: white;',
                ],
                'label_html' => true,
            ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
