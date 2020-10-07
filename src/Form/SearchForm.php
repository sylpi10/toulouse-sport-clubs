<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\PostalCode;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', TextType::class, [
                'label' => "Sport",
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ex: Jiu Jitsu'
                ]
            ])
            ->add('cat', TextType::class, [
                'label' => "Catégorie",
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ex: Sports De Combat'
                ]
            ])
       
            ->add('postals', EntityType::class, [
                'required' => false,
                'class' => PostalCode::class,
                'expanded' => true,
                'multiple' => true,
            ])        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
    
}