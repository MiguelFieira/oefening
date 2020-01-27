<?php

namespace App\Form;

use App\Entity\Wedstrijden;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WedstrijdenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('score1')
            ->add('score2')
            ->add('toernooi')
            ->add('speler1')
            ->add('speler2')
            ->add('winaar')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Wedstrijden::class,
        ]);
    }
}
