<?php

namespace Festival\HebergementBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HebergementType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('date',      DateTimeType::class) 
      ->add('groupe', EntityType::class, array(
        'class'        => 'FestivalGroupeBundle:Groupe',
        'choice_label' => 'nom',
        'multiple'     => false,
      ))
      ->add('chambre', EntityType::class, array(
        'class'        => 'FestivalEtablissementBundle:Chambre',
        'choice_label' => 'nomChambre',
        'multiple'     => false,
      ))
      ->add('save',      SubmitType::class);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'Festival\HebergementBundle\Entity\Hebergement'
    ));
  }
}
