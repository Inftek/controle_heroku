<?php

namespace MRS\ControleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TbKilometragemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('kiDescricao',TextType::class,['label' => 'Descrição:',
                                                 'attr' => ['class' =>'input-sm']])
            ->add('kiKilometragem',TextType::class, ['label' => 'Kilometragem:',
                                                     'attr' => ['class' =>'input-sm']])
            ->add('kiDataInicial',DateType::class,['label' => 'Data Inicial:',
                                                    'widget'=>'single_text',
                                                    'attr' => ['class'=>'input-sm']])
            ->add('kiDataAtual',DateType::class,['label' => 'Data Atual:',
                                                 'widget'=>'single_text',
                                                 'attr' => ['class'=>'input-sm']])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'validation_group' => array('update','create'),
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'mrs_controlebundle_tbkilometragem';
    }

}
