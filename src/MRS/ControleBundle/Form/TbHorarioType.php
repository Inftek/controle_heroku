<?php

namespace MRS\ControleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TbHorarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('horDiaSemana',TextType::class,array('label'=>'Dia da Semana',
                                                       'attr' => array('class'=>'input-sm')))
            ->add('horData',DateType::class,array('label'=>'Data',
                                                  'widget'=>'single_text',
                                                  'attr' => array('class'=>'input-sm')))
            ->add('horEntrada',TimeType::class,array('label'=>'Entrada',
                                                     'widget'=>'single_text',
                                                     'attr' => array('class'=>'input-sm')))

            ->add('horAlmocoIda',TimeType::class,array('label'=>'Almoço Saída',
                                                       'widget'=>'single_text',
                                                       'attr' => array('class'=>'input-sm')))
            ->add('horAlmocoVolta',TimeType::class,array('label'=>'Almoço Retorno',
                                                         'widget'=>'single_text',
                                                         'attr' => array('class'=>'input-sm')))
            ->add('horSaida',TimeType::class,array('label'=>'Saída',
                                                   'widget'=>'single_text',
                                                   'attr' => array('class'=>'input-sm')))
            ->add('horJustificativa',TextType::class,array('label'=>'Justificativa',
                                                           'attr' => array('class'=>'input-sm')))
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MRS\ControleBundle\Entity\TbHorario'
        ));
    }

//    /**
//     * @param OptionsResolverInterface $resolver
//     */
//    public function setDefaultOptions(OptionsResolverInterface $resolver)
//    {
//
//    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'mrs_controlebundle_tbhorario';
    }
}
