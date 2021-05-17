<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

final class ScoreAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('score',null,['label' => 'Puntuación'])
            ->add('user',null,['label' => 'Usuario'])
            ->add('recipe',null,['label' =>'Receta'])
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('user', CollectionType::class,['label' =>'Usuario'])
            ->add('recipe', CollectionType::class,['label' =>'Receta'])
            ->add('score',null,['label' =>'Puntuación'])
            ->add('_action', null, [
                'label' =>'Acciones',
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
            ->add('id')
            ->add('score',null,['label' =>'Puntuación'])
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('score',null,['label' =>'Puntuación'])
            ->add('user',null,['label' =>'Usuario'])
            ->add('recipe', null,['label' =>'Receta'])
            ;
    }
    
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('create')
            ;
    }
}
