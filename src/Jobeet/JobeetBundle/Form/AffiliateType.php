<?php

namespace Jobeet\JobeetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AffiliateType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url')
            ->add('email')
            ->add('token')
            ->add('isActive')
            ->add('category')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jobeet\JobeetBundle\Entity\Affiliate'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jobeet_jobeetbundle_affiliate';
    }
}
