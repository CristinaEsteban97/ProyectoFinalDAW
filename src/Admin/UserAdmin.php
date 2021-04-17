<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class UserAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('email')
            ->add('roles')
            ->add('username',null,['label' =>'Nombre de usuarioss'])
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('email',null,['label' =>'Email'])
            ->add('roles')
            ->add('password',null,['label' =>'Contraseña'])
            ->add('username',null,['label' =>'Nombre de usuario '])
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
            ->add('email')
            ->add('roles')
            ->add('password',null,['label' =>'Contraseña'])
            ->add('username',null,['label' =>'Nombre de usuario'])
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('email')
            ->add('roles')
            ->add('password',null,['label' =>'Contraseña'])
            ->add('username',null,['label' =>'Nombre de usuario '])
            ;
    }
}
