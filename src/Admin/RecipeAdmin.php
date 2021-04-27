<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\ModelListType;



final class RecipeAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
        ->add('title',null,['label' =>'Título'])
        ->add('image',null,['label' =>'Imagen'])
        ->add('description',null,['label' =>'Descripción'])
        ->add('score',null,['label' =>'Puntuación'])
        ->add('visible')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('user', CollectionType::class,['label' =>'Usuario'])
            ->add('title',null,['label' =>'Título'])
            ->add('image',null,['label' =>'Imagen'])
            ->add('description',null,['label' =>'Descripción'])
            ->add('score',null,['label' =>'Puntuación'])
            ->add('visible',null,['label' =>'Visible'])
            ->add('_action', null, [
                'label' => 'Acciones',
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('title',null,['label' =>'Título'])
            ->add('image',null,['label' =>'Imagen'])
            ->add('description',null,['label' =>'Descripción'])
            ->add('score',null,['label' =>'Puntuación'])
            ->add('visible')
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('title',null,['label' =>'Título'])
            ->add('image',null,['label' =>'Imagen'])
            ->add('description',null,['label' =>'Descripción'])
            ->add('user', CollectionType::class)
            ->add('score',null,['label' =>'Puntuaciones'])
            ->add('visible')
            ;
    }
}
