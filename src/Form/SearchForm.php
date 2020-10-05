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
            // ->add('d31000', CheckboxType::class,[
            //     'label' => 'Toulouse Centre',
            //     'required' => false,
            //     'attr' => [
            //         'value' => '31000',
            //         'class' => 'checkbox check31000',
            //     ]
            //     ])
            // ->add('d31100', CheckboxType::class,[
            //     'label' => 'Toulouse Rive gauche',
            //     'required' => false,
            //     'attr' => [
            //         'value' => '31100',
            //         'name' =>'31100',
            //         'class' => 'checkbox check31100'
            //     ]
            //     ])
            // ->add('d31200', CheckboxType::class,[
            //     'label' => 'Toulouse Nord',
            //     'required' => false,
            //     'attr' => [
            //         'value' => '31200',
            //         'class' => 'checkbox check31200'
            //     ]
            //     ])
            // ->add('d31500', CheckboxType::class,[
            //     'label' => 'Toulouse Est',
            //     'required' => false,
            //     'attr' => [
            //         'value' => '31500',
            //         'class' => 'checkbox check31500'
            //     ]
            //     ])
            // ->add('d31300', CheckboxType::class,[
            //     'label' => 'Toulouse Ouest',
            //     'required' => false,
            //     'attr' => [
            //         'value' => '31300',
            //         'class' => 'checkbox check31300'
            //     ]
            //     ])
            // ->add('d31400', CheckboxType::class,[
            //     'label' => 'Toulouse Sud Est',
            //     'required' => false,
            //     'attr' => [
            //         'value' => '31400',
            //         'name' =>'31400',
            //         'class' => 'checkbox check31400'
            //     ]
            //     ])
       
            ->add('postals', EntityType::class, [
                'required' => false,
                'class' => PostalCode::class,
                'expanded' => true,
                'multiple' => true,
                'label' => 'number',
                'attr' => [
                    'class' => 'checkbox'
                ]
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