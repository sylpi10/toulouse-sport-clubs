<?php

namespace App\Form;

use App\Controller\ApiController;
use App\Data\SearchData;
use App\Entity\Category;
use App\Entity\PostalCode;
use App\Entity\SportClub;
use App\Repository\SportClubRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
                    'placeholder' => 'Ex: Karaté'
                ]
            ])
            // ->add('categories', EntityType::class, [
            //     'label' => "Catégorie",
            //     'placeholder' => "Ex: Sports de Combat",
            //     'required' => false,
            //     'mapped' => false,
            //     'class' => Category::class,
            //     // 'expanded' => true,
            //     'choice_label' => function (Category $categ)
            //     {   
            //         return $categ;
            //     }, 
                
            // ])
       
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