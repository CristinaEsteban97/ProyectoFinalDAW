<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('search',null,[
                'label' => 'Buscador',
                'label_attr' => ['class' => "align-self-center"]
            ])
            ->add('save', SubmitType::class, [
                'label' => "Buscar",
                'attr' => ['class' => 'save'],
            ]);
        ;
    }
}
