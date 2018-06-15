<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BlagueAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('titre', TextType::class);
        $formMapper->add('contenu', TextareaType::class);
        $formMapper->add('categories', EntityType::class,
            array(
                'class' => 'App\Entity\Categorie',
                'choice_label' => 'libelle',
                'multiple' => true,
            ));
        $formMapper->add('date', DateType::class);
        $formMapper->add('user', EntityType::class,
            array('class' => 'App\Entity\User',
                'choice_label' => 'username',
            ));
        $formMapper->add('etat', EntityType::class,
            array('class' => 'App\Entity\Etat',
                'choice_label' => 'libelle'
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('titre');
        $datagridMapper->add('date');
        //$datagridMapper->add('user');
        //$datagridMapper->add('etat');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->add('titre');
        $listMapper->add('date');
        $listMapper->add('user');
        $listMapper->add('etat');
    }
}