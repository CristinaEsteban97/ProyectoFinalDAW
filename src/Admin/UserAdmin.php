<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\BCryptPassword;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

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
            ->add('roles', ChoiceType::class, [
                'multiple' => true,
                'choices' => ['ROLE_USER' => 'ROLE_USER', 'ROLE_ADMIN' => 'ROLE_ADMIN']
            ])
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array('label' => 'Contraseña'),
                'second_options' => array('label' => 'Repite contraseña'),
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor introduce una contraseña',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Tu contraseña debe tener al menos {{ limit }} caracteres',
                        'max' => 4096,
                    ]),
                ],    ))
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

    public function preUpdate($object) {
        $uniqid = $this->getRequest()->query->get('uniqid');
        $encoder = new BCryptPasswordEncoder(13);
        $formData = $this->getRequest()->request->get($uniqid);
        if(array_key_exists('password', $formData) && $formData['password'] !== null && strlen($formData['password']['first' ]) > 0) {
            $object->setPassword($encoder->encodePassword($formData['password']['first' ],$object->getSalt()));
        }
    }

    public function prePersist($object) {
        $plainPassword = $object->getPassword();
        $container = $this->getConfigurationPool()->getContainer();
        $encoder = $container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($object, $plainPassword);
    
        $object->setPassword($encoded);
    }
}
