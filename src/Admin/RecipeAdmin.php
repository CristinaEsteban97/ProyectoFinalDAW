<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class RecipeAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
        ->add('name',null,['label' =>'Nombre'])
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
            ->add('name',null,['label' =>'Nombre'])
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
            ->add('name',null,['label' =>'Nombre'])
            ->add('image',null,['label' =>'Imagen'])
            ->add('description',null,['label' =>'Descripción'])
            ->add('score',null,['label' =>'Puntuación'])
            ->add('visible')
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('name',null,['label' =>'Nombre'])
            ->add('image',null,['label' =>'Imagen'])
            ->add('description',null,['label' =>'Descripción'])
            ->add('user',null,['label' =>'Usuario'])
            ->add('score',null,['label' =>'Puntuaciones'])
            ->add('visible')
            ;
    }
}
