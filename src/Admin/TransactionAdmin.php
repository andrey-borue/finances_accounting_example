<?php
namespace App\Admin;

use Doctrine\ORM\QueryBuilder;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class TransactionAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper): void
    {
//        $formMapper->add('name', TextType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('account.user.id')
        ;

        $this->addDateRangeFilter($datagridMapper, 'createdAt');
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
//        $query = parent::createQuery('list');
//        /** @var QueryBuilder $qb */
//        $qb = $query->getQueryBuilder();
//
//
//        var_dump($qb->getQuery()->getDQL()); exit;

        $listMapper
            ->add('id')
            ->add('account.user')
            ->add('account.currency.code')
            ->add('income', null, ['template' => 'TransactionAdmin/list_income.html.twig'])
            ->add('outcome', null, ['template' => 'TransactionAdmin/list_outcome.html.twig'])
            ->add('createdAt')
        ;
    }

    protected function configureRoutes(RouteCollection $collection): void
    {
        $collection->remove('create');
        $collection->remove('edit');
        $collection->remove('delete');
    }
}
