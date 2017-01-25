<?php

namespace PW\QCMBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QCMType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('enonce', 'textarea')
                ->add('propoA', 'text')
                ->add('propoB', 'text')
                ->add('propoC', 'text')
                ->add('propoD', 'text', array('required' => false))
                ->add('propoE', 'text', array('required' => false))
                ->add('reponse', 'text')
                ->add('explication', 'textarea')
                ->add('urlPhoto', 'text', array('required' => false))
                ->add('save', 'submit')         ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PW\QCMBundle\Entity\QCM'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pw_qcmbundle_qcm';
    }


}
