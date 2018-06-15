<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;


class NoteAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('note', NumberType::class);
        $formMapper->add('user', EntityType::class);
        $formMapper->add('blague', EntityType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('note');
        $datagridMapper->add('user');
        $datagridMapper->add('blague');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->add('note');
        $listMapper->add('user');
        $listMapper->add('blague');
    }
}