<?php

namespace App\Form;

use App\Entity\Clients;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rs')
            ->add('nom')
            ->add('prenom')
            ->add('entreprise')
            ->add('adresse')
            ->add('cp')
            ->add('tel')
            ->add('fax')
            ->add('email')
            ->add('tva')
            ->add('ape')
            ->add('catalogues')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Clients::class,
        ]);
    }
}
