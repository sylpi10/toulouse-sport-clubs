<?php

namespace App\Form;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class FormClubType extends AbstractType
{
    public function builform(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', NumberType::class, [
                'attr'=> [
                    'placeholder' => "zip code"
                ]
            ])
            ->add('discipline', TextType::class, [
                'attr' => [
                    'placeholder' => 'Discipline',
                ]
            ]);
    }
}