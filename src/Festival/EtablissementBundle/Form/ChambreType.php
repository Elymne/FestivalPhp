<?php

namespace Festival\EtablissementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ChambreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomChambre',         TextType::class)
            ->add('nbPlaces',           TextType::class)
            ->add('idEtablissement',    EntityType::class, array(
                'class'        => 'FestivalEtablissementBundle:Etablissement',
                'choice_label' => 'nom',
                'multiple'     => false,
      ))
            ->add('save',    SubmitType::class)
        ;
  }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Festival\EtablissementBundle\Entity\Chambre'
        ));
    }
}