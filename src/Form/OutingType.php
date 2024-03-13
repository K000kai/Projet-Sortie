<?php

namespace App\Form;

use App\Entity\Outing;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class OutingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('dateTimeStart', null, [
                'widget' => 'single_text'
            ])
            ->add('duration')
            ->add('registrationDeadline', null, [
                'widget' => 'single_text'
            ])
            ->add('nbRegistrationMax')
            ->add('infoOuting');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Outing::class,
        ]);
    }
}
