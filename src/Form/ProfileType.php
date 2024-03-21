<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Profile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Username',null,['label' => 'Pseudo'])
            ->add('Name',null,['label' => 'Nom'])
            ->add('Surname',null,['label' => 'Prénom'])
            ->add('Phone',null,['label' => 'Téléphone'])
            ->add('Email')
            /*->add('Picture')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profile::class,
        ]);
    }
}
