<?php
namespace App\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper->add('name', TextType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper->add('_action', 'actions', [
            'actions' => [
                'edit' => [],
                'transactions' => ['template' => 'UserAdmin/list__action_transactions.html.twig']
            ],

        ]);
        $listMapper
            ->add('name')
            ->add('city')
            ->add('country')
        ;
    }

    protected function configureRoutes(RouteCollection $collection): void
    {

    }
}
