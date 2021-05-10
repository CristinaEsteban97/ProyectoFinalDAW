<?php

namespace App\Form;

use App\Entity\Score;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;

class ScoreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user',HiddenType::class)
            ->add('recipe',HiddenType::class)
            ->add('score',HiddenType::class,[
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Campo obligatorio',
                    ]),
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => "Valora",
                'attr' => ['class' => 'save'],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Score::class,
        ]);
    }
}
