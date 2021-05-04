<?php

namespace App\Form;

use App\Entity\Recipe;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;


class UploadRecipesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class,[
                'label' => 'Título',
            ])
            ->add('image',FileType::class,[
                'label' => 'Imagen',
            ])
            ->add('categories',EntityType::class,[
                'class' => Category::class,
                'mapped' => true,
                'label' => 'Categoria',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false
            ])
            ->add('description',CKEditorType::Class,[
                'config' => [
                    'toolbar' =>  'my_toolbar_2',
                ],              
                'label' => 'Pasos',
                'label_attr' => ['class' => "mt-3 mb-3"]

            ])
            ->add('ingredients', CKEditorType::Class, array(
                'config' => [
                    'toolbar' =>  'my_toolbar_1',
                ],                 
                'label' => 'Ingredientes',
                'label_attr' => ['class' => "mb-3"]
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
