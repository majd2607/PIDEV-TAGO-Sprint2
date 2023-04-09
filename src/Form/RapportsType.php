<?php

namespace App\Form;

use App\Entity\Rapports;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cout')
            ->add('pieceschangees')
            ->add('tachesrealisees')
            ->add('description')
            ->add('archive')
            ->add('idmaintenance')
            ->add('idtechnicien');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rapports::class,
        ]);
    }
}
