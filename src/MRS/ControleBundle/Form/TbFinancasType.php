<?php

namespace MRS\ControleBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class TbFinancasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * Fix
     * 'years' =>range(date('Y'),date('Y')),
     * 'months' => range(date('m'),date('m')),
     * 'days' => range(date('d'),date('d'))
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('finDataCadastro',DateType::class,array('label' => 'Data',
                                                          'widget'=>'single_text',
                                                          'attr' => array('class' => 'input-sm')))
            ->add('finValor',MoneyType::class, array('currency' => 'BRL',
                                                     'scale' => 2,
                                                     'label' => 'Valor',
                                                     'attr' => array('class'=>'input-sm')))
            ->add('finDescricao',TextType::class,array('label' => 'Descrição',
                                                       'attr' => array('class'=>'input-sm')))
            ->add('tenCodigo',EntityType::class, array('label'=> 'Tipo',
                                              'class' => 'MRSControleBundle:TbTipoEntrada',
                                              'placeholder' => false,
                                              'attr' => array('class'=>'input-sm')))
            ->add('catCodigo',EntityType::class,array('label' => 'Categoria',
                                             'attr' => array('class' => 'input-sm'),
                                             'class' => 'MRS\ControleBundle\Entity\TbCategoria'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MRS\ControleBundle\Entity\TbFinancas'
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'mrs_controlebundle_tbfinancas';
    }
}
