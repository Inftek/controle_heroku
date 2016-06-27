<?php

namespace MRS\ControleBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TbFinancasType extends AbstractType
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->tokenStorage
            ->getToken()
            ->getUser()
            ->getId();

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
                    'attr' => array('class'=>'input-sm'),
                    'class' => 'MRSControleBundle:TbTipoEntrada',
                    'query_builder' => function(EntityRepository $er)use($user){
                        return $er->createQueryBuilder('Entrada')
                            ->where('Entrada.user = :user')
                            ->setParameter('user',$user);
                    },
                    'placeholder' => false
                )
            )->add('catCodigo',EntityType::class,array('label'=>'Categoria',
                    'attr'=> array('class'=>'select2'),
                    'class' => 'MRSControleBundle:TbCategoria',
                    'query_builder' => function(EntityRepository $er)use($user){
                        return $er->createQueryBuilder('Categoria')
                            ->where('Categoria.user = :user')
                            ->setParameter('user',$user);

                    })
            )
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
