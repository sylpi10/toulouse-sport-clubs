<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Category;
use App\Entity\SportClub;
use App\Entity\PostalCode;
use App\Controller\ApiController;
use App\Repository\SportClubRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class SearchForm extends AbstractType
{
    private $router;
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', TextType::class, [
                'label' => "Sport",
                'required' => false,
                'attr' => [
                    'placeholder' => 'Ex: Karaté',
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
            // ->add('q', EntityType::class, [
            //     'label' => "discipline",
            //     'placeholder' => "Ex: karaté",
            //     'required' => false,
            //     'mapped' => false,
            //     'class' => SportClub::class,
            //     // 'expanded' => true,
            //     'choice_label' => function (SportClub $club)
            //     {   
            //         return $club->getDiscipline();
            //     }, 
            //     'choice_value' => function (?SportClub $entity) {
            //         return $entity ? $entity->getDiscipline() : '';
            //     },
                
            // ])
       
            ->add('postals', EntityType::class, [
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
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
    
}