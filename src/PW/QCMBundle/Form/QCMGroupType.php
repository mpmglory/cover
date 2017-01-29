<?php

namespace PW\QCMBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use PW\QCMBundle\Repository\MatiereRepository;

class QCMGroupType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre', 'textarea')
                ->add('description', 'textarea')
                ->add('matiere', 'entity', array(
                    'class' => 'PWQCMBundle:Matiere',
                    'property' => 'nom',
                    'expanded' => false,
                    'multiple' => false,
                    'query_builder' => function(MatiereRepository $repo){
                        return $repo->getTheseConcoursMatiere();
                    }
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
            'data_class' => 'PW\QCMBundle\Entity\QCMGroup'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'pw_qcmbundle_qcmgroup';
    }


}
