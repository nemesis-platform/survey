<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 25.05.2015
 * Time: 13:18
 */

namespace ScayTrase\SurveyBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SurveyFormType extends AbstractType
{

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'survey_form';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('alias');
        $builder->add('title');
        $builder->add('editAllowed', null, array('required' => false));
        $builder->add('locked', null, array('required' => false));
        $builder->add('public', null, array('required' => false));

        $builder->add(
            'questions',
            'bootstrap_collection',
            array(
                'type'         => new SurveyQuestionType(),
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'options'      => array(
                    'attr' => array('style' => 'inline'),
                ),
            )
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'ScayTrase\SurveyBundle\Entity\Survey'));
    }
}
