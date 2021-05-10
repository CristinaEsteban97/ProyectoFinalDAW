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
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Sonata\AdminBundle\Route\RouteCollection;





final class RecipeAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
        ->add('title',null,['label' =>'Título'])
        ->add('image',null,['label' =>'Imagen'])
        ->add('description',null,['label' =>'Descripción'])
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
            $image = $this->getSubject();

            // use $fileFormOptions so we can add other options to the field
            $fileFormOptions = ['required' => false];
            if ($image && ($webPath = $image->getImage())) {
                // get the request so the full path to the image can be set
                $request = $this->getRequest();
                $fullPath = $request->getBasePath().'/'.$webPath;
    
                // add a 'help' option containing the preview's img tag
                $fileFormOptions['help'] = '<img src="'.$fullPath.'" class="admin-preview"/>';
                $fileFormOptions['help_html'] = true;
            }

            $formMapper
            ->add('title',null,['label' =>'Título'])
            //->add('image', FileType::class, $fileFormOptions)
            ->add('description',null,['label' =>'Descripción'])
            ->add('ingredients',null,['label' =>'Ingredientes'])
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
            ->add('visible')
            ->add('categories',null,['label' =>'Categorias'])
            ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('create')
            ;

    }
}
