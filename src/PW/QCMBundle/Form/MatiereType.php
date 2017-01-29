<?php

namespace PW\QCMBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatiereType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',     'textarea')
                ->add('description',     'textarea')
                ->add('concours', 'entity', array(
                    'class' => 'PWQCMBundle:Concours',
                    'property' => 'nom',
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
            'data_class' => 'PW\QCMBundle\Entity\Matiere'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pw_qcmbundle_matiere';
    }


}
