<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\City;
use App\Entity\Location;
use App\Entity\Outing;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OutingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('name',null, [
                'label' => 'Nom de la sortie'
            ])
            ->add('dateTimeStart', null, [
                'widget' => 'single_text',
                'label'=> 'Date et heure de la sortie'
            ])
            ->add('registrationDeadline', null, [
                'widget' => 'single_text',
                'label' => 'Date limite d\'inscription'
            ])
            ->add('duration',null, [
                'label' => 'Durée en minutes'
            ])
            ->add('nbRegistrationMax',null, [
                'label' => 'Nombre de places'
            ])
            ->add('infoOuting',TextareaType::class, [
                'attr' => ['rows' => 5],
                'label' => 'Description de la sortie'
            ])
            ->add('city', EntityType::class, [
            'class' => City::class,
            'choice_label' => 'name',
            'label' => 'Ville',
            'placeholder' => 'Sélectionnez une ville',
            'mapped' => false, // Ce champ ne mappe pas à une propriété de l'entité Outing
            ])
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'name',
                'label' => 'Lieu',
                'placeholder' => 'Sélectionnez un lieu',
                'required' => false,
                'mapped' => true,
            ]);
        ;

    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Outing::class,
        ]);
    }
}
