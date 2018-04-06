<?php

namespace Festival\EtablissementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EtablissementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',                TextType::class)
            ->add('adresse',            TextType::class)
            ->add('codePostal',         TextType::class)
            ->add('ville',              TextType::class) 
            ->add('telephone',          TextType::class)
            ->add('email',              TextType::class)
            ->add('telephone',          TextType::class)
            ->add('type',               ChoiceType::class,array(
                'choices'  => array(
                    'Etablissement Scolaire' => true,
                    'Autre' => false,
                ))
            )
            ->add('civilite',           ChoiceType::class,array(
                'choices'  => array(
                    'Madame' => 'Madame',
                    'Monsieur' => 'Monsieur',
                ))
            )
            ->add('nomResp',            TextType::class)
            ->add('prenomResp',         TextType::class)
            ->add('save',    SubmitType::class)
            ;
         
  }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Festival\EtablissementBundle\Entity\Etablissement'
        ));
    }
}