<?php

namespace Festival\GroupeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class GroupeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',            TextType::class)
            ->add('responsable',    TextType::class)
            ->add('adresse',        TextType::class)
            ->add('nbPersonnes',    IntegerType::class) 
            ->add('pays',           TextType::class)
            ->add('hebergement',    CheckboxType::class)
            ->add('save',           SubmitType::class);
  }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Festival\GroupeBundle\Entity\Groupe'
        ));
    }
}
