<?php

namespace App\Form;

use App\Entity\Campus;
use App\Model\SearchFilterData;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class FilterType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('zoneRecherche', TextType::class, [
                'label' => 'Le nom de la sortie contient :',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher'
                ]
            ])
            ->add('Campus', EntityType::class, [
                'label' => 'Campus',
                'required' => false,
                'class' => Campus::class,

            ])
            ->add('min', DateTimeType::class, [
                'label' => 'Entre',
                'required' => false,
                'widget' => 'single_text',
            ])
            ->add('max', DateTimeType::class, [
                'label' => 'et',
                'required' => false,
                'widget' => 'single_text',
            ])
            ->add('organisateur', CheckboxType::class, [
                'label' => 'Sorties dont je suis l‘organisateur/trice',
                'required' => false,
            ])
        ;


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchFilterData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix(): string
    {
        return'';
    }

}