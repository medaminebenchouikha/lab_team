<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnseignantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAction($options['action'])
                ->add('nom', TextType::class,
                    array('required'=>'true','label'=>'Name Professor'))
                ->add('cin',NumberType::class)
                ->add('image',FileType::class,array(
                    'label'=>'Select your picture'
                ))
                ->add('cours', EntityType::class,array(
                    'class'=>'AppBundle\Entity\Cours',
                    'choice_label'=>'designation'
                ))
                ->add('sections',EntityType::class,array(
                    'class'=>'AppBundle\Entity\Section',
                    'choice_label'=>'designation',
                    'multiple'=>'true',
                    'expanded'=>'true'
                ))
                ->add('Envoyer',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Enseignant'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_enseignant';
    }


}
