<?php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin as BaseAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type\DateRangePickerType;
use Sonata\DoctrineORMAdminBundle\Filter\DateRangeFilter;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AbstractAdmin extends BaseAdmin
{

    protected function addDateRangeFilter(DatagridMapper $datagridMapper, string $fieldName)
    {
        $datagridMapper->add($fieldName, DateRangeFilter::class, [
            'field_type' => DateRangePickerType::class,
            'field_options' => ['field_options' => ['format' => DateType::HTML5_FORMAT]]
        ]);
    }


    protected function addFormFieldId(FormMapper $formMapper, $with = false)
    {
        if ($with) {
            $formMapper->with($with);
        }
        $formMapper
            ->add('Id', null, ['disabled' => true, 'required' => false, 'attr' => ['style' => 'width:100px;']]);

        if ($with) {
            $formMapper->end();
        }

        return $this;
    }


    /**
     * @param FormMapper $formMapper
     * @throws \RuntimeException
     * @param string $with
     */
    protected function addFormFieldCreatedAndUpdatedAt(FormMapper $formMapper, $with = null)
    {
        $this->addFormFieldUpdatedAt($formMapper, $with);
        $this->addFormFieldCreatedAt($formMapper, $with);
    }

    /**
     *
     * @param FormMapper $formMapper
     * @param string $with
     * @throws \RuntimeException
     * @return $this
     */
    protected function addFormFieldCreatedAt(FormMapper $formMapper, $with = null)
    {
        if ($with) {
            $formMapper->with($with);
        }

        $formMapper->add(
            'createdAt',
            'datetime',
            [
                'disabled' => true,
                'required' => false,
                'attr' => ['style' => 'width: 270px'],
                'widget' => 'single_text',
            ]
        );

        if ($with) {
            $formMapper->end();
        }

        return $this;
    }

    /**
     * @param FormMapper $formMapper
     * @param string $with
     * @throws \RuntimeException
     * @return $this
     */
    protected function addFormFieldUpdatedAt(FormMapper $formMapper, $with = null)
    {
        if ($with) {
            $formMapper->with($with);
        }

        $formMapper->add(
            'updatedAt',
            'datetime',
            [
                'disabled' => true,
                'required' => false,
                'attr' => ['style' => 'width: 270px'],
                'widget' => 'single_text',
            ]
        );

        if ($with) {
            $formMapper->end();
        }

        return $this;
    }

    /**
     * @param ListMapper $listMapper
     * @throws \RuntimeException
     */
    protected function addListFieldsEditAction(ListMapper $listMapper)
    {
        if ($this->isGranted('EDIT') && $this->getRoutes()->has('edit')) {
            $listMapper->add('_action', 'actions', ['actions' => ['edit' => []]]);
        } elseif ($this->getRoutes()->has('show')) {
            $this->addListFieldsViewAction($listMapper);
        }
    }

    /**
     * @param ListMapper $listMapper
     * @throws \RuntimeException
     */
    protected function addListFieldsViewAction(ListMapper $listMapper)
    {
        if ($this->isGranted('VIEW') && $this->getRoutes()->has('show')) {
            $listMapper->add('_action', 'actions', ['actions' => ['view' => []], 'header_style' => 'width: 30px;']);
        }
    }

    /**
     * @param ListMapper $listMapper
     * @throws \RuntimeException
     */
    protected function addListFieldsEditAndViewAction(ListMapper $listMapper)
    {
        if ($this->isGranted('EDIT') && $this->getRoutes()->has('edit')) {
            $listMapper->add('_action', 'actions', ['actions' => ['edit' => [], 'view' => []], 'header_style' => 'width: 90px;', 'label' => 'Actions       ']);
        } elseif ($this->getRoutes()->has('show')) {
            $this->addListFieldsViewAction($listMapper);
        }
    }


}