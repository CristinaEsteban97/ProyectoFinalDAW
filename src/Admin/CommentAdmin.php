<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

final class CommentAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('text',null,['label' =>'Texto'])
            ->add('visible')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('text',null,['label' =>'Texto'])
            ->add('user', CollectionType::class,['label' =>'Usuario'])
            ->add('recipe', CollectionType::class, ['label' =>'Receta'])
            ->add('visible')
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
            ->add('text',null,['label' =>'Texto'])
            ->add('visible')
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('text',null,['label' =>'Texto'])
            ->add('visible')
            ->add('user', CollectionType::class,['label' =>'Usuario'])
            ->add('recipe', CollectionType::class,['label' =>'Receta'])
            ;
    }
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('create')
            ;
    }
}
