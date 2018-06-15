<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CommentaireAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('contenu');
        $formMapper->add('user');
        $formMapper->add('blague');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('contenu');
        
        $datagridMapper->add('blague');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('contenu');
        $listMapper->addIdentifier('user');
        $listMapper->addIdentifier('blague');
    }
}