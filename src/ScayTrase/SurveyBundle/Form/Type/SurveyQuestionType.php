<?php
/**
 * Created by PhpStorm.
 * User: Pavel Batanov <pavel@batanov.me>
 * Date: 10.06.2015
 * Time: 14:05
 */

namespace ScayTrase\SurveyBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SurveyQuestionType extends AbstractType
{

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'survey_question';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'field',
            'entity',
            array(
                'label' => 'Поле',
                'class' => 'ScayTrase\StoredFormsBundle\Entity\Field\AbstractField',
            )
        );
        $builder->add('weight', 'integer', array('label' => 'Вес'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'ScayTrase\SurveyBundle\Entity\SurveyQuestion'));
    }


}
