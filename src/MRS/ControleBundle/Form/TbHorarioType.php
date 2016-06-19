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
            ->add('horDiaSemana')
            ->add('horData',DateType::class,array('label'=>'Data',
                                                  'widget'=>'single_text'))
            ->add('horEntrada',TimeType::class,array('label'=>'Entrada'))
            ->add('horAlmocoIda',TimeType::class,array('label'=>'Almoço Saída'))
            ->add('horAlmocoVolta',TimeType::class,array('label'=>'Almoço Retorno'))
            ->add('horSaida',TimeType::class,array('label'=>'Saída'))
            ->add('horJustificativa',TextType::class,array('label'=>'Justificativa'))
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
