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
        $builder->add('enonce',     'textarea')
                ->add('propoA',     'textarea')
                ->add('propoB',     'textarea')
                ->add('propoC',     'textarea')
                ->add('propoD',     'textarea')
                ->add('propoE',     'textarea')
                ->add('reponse',    'choice', array(
                    'choices' => array(
                        'A' => 'Proposition A',
                        'B' => 'Proposition B',
                        'C' => 'Proposition C',
                        'D' => 'Proposition D',
                        'E' => 'Proposition E',
                        ),
                    'required' => true,
                    'expanded' => false,
                    'multiple' => false,
                    ))
                ->add('explication', 'textarea')
                ->add('qcmgroup', 'entity', array(
                    'class' => 'PWQCMBundle:QCMGroup',
                    'property' => 'titre',
                    'expanded' => false,
                    'multiple' => false,
                    ))
                ->add('image',   new ImageType())
                ->add('submit',     'submit')
                ;
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
