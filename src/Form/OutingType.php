<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Location;
use App\Entity\Outing;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
                'label' => 'Durée'
            ])
            ->add('nbRegistrationMax',null, [
                'label' => 'Nombre de places'
            ])
            ->add('infoOuting',TextareaType::class, [
                'attr' => ['rows' => 5],
                'label' => 'Description de la sortie'
            ])
            ->add('campus', EntityType::class, [
                'class' => Campus::class,
                'choice_label' => 'name',
            ])
            ->add('location', CollectionType::class, [
                'entry_type' => LocationType::class,
                'by_reference' => false
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Outing::class,
        ]);
    }
}
