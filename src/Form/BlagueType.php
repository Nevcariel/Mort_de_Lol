<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Blague;
use App\Entity\Categorie;
use App\Entity\User;
use App\Entity\Etat;


class BlagueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre', TextType::class);
        $builder->add('contenu', TextareaType::class);
        $builder->add('categories', EntityType::class,
            array(
                'class' => 'App\Entity\Categorie',
                'choice_label' => 'libelle',
                'multiple' => true,
                'expanded' => true
            ));
        $builder->add('save', SubmitType::class, array('label' => 'Ajouter'));
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Blague::class,
        ));
    }
}